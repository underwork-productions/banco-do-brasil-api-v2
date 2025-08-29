<?php

require_once __DIR__.'/vendor/autoload.php';

$header = <<<'HEADER'
<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Builder classes
 *
 * @author Underwork Productions <underwork.productions@gmail.com>
 */
HEADER;

$filePath = __DIR__.'/_ide_helper_builders.php';
file_put_contents($filePath, $header."\n\n");

$directory = __DIR__.'/src';
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file) {
    if ($file->getExtension() !== 'php') {
        continue;
    }
    $code = file_get_contents($file->getPathname());
    if (strpos($code, 'HasBuilder') === false) {
        continue;
    }

    if (preg_match('/namespace\s+([^;]+);/', $code, $nsMatch) &&
        preg_match('/class\s+([^\s{]+)/', $code, $classMatch)) {
        $namespace = trim($nsMatch[1]);
        $className = trim($classMatch[1]);
        $fqcn = $namespace.'\\'.$className;
        require_once $file->getPathname();
        if (! class_exists($fqcn)) {
            continue;
        }

        $ref = new ReflectionClass($fqcn);

        $helperNamespace = $namespace;
        $helperClass = "IdeHelper{$className}Builder";
        $methods = [];
        foreach ($ref->getProperties() as $prop) {
            $propName = $prop->getName();
            $type = 'mixed';
            if ($prop->hasType()) {
                $typeObj = $prop->getType();
                if ($typeObj instanceof ReflectionNamedType) {
                    $type = $typeObj->getName();
                }
            }
            $methods[] = " * @method static $helperClass $propName($type \$value)";
            $methods[] = " * @method $helperClass $propName($type \$value)";
        }

        // Write stub helper class in Laravel IDE Helper style
        $stub = "namespace $helperNamespace {\n";
        $stub .= "    /**\n     * Helper for $fqcn\n";
        foreach ($methods as $method) {
            $stub .= "    $method\n";
        }
        $stub .= "     */\n";
        $stub .= "    #[\\AllowDynamicProperties]\n";
        $stub .= "    class $helperClass {}\n";
        $stub .= "}\n\n";
        file_put_contents($filePath, $stub, FILE_APPEND);

        // Update real class docblock with @mixin
        $doc = $ref->getDocComment() ?: '';
        $mixinTag = "@mixin $helperClass";
        if ($doc && strpos($doc, $mixinTag) === false) {
            // Append @mixin to docblock
            $newDoc = preg_replace('/\\*\\//', " * $mixinTag\\n */", $doc, 1);
            $code = str_replace($doc, $newDoc, $code);
            file_put_contents($file->getPathname(), $code);
        } elseif (! $doc) {
            // Add docblock with @mixin
            $newDoc = "/**\n * $mixinTag\n */\n";
            $code = preg_replace('/(class\\s+'.$className.')/', "$newDoc\$1", $code, 1);
            file_put_contents($file->getPathname(), $code);
        }
    }
}

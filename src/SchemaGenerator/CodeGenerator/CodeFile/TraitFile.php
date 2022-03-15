<?php

declare(strict_types=1);

namespace GraphQL\SchemaGenerator\CodeGenerator\CodeFile;

use Nette\PhpGenerator\ClassLike;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\TraitType;

/**
 * Class TraitFile.
 */
class TraitFile extends AbstractCodeFile
{
    /** @var TraitType */
    protected ClassLike $classLike;

    protected function createClassLikeClass(string $className, ?string $namespace = ''): ClassLike
    {
        return new TraitType($className, new PhpNamespace($namespace));
    }
}

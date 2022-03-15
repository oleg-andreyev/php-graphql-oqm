<?php

declare(strict_types=1);

namespace GraphQL\SchemaObject;

use GraphQL\Query;
use GraphQL\QueryBuilder\AbstractQueryBuilder;

/**
 * An abstract class that acts as the base for all schema query objects generated by the SchemaClassGenerator.
 *
 * Class QueryObject
 */
abstract class QueryObject extends AbstractQueryBuilder
{
    /**
     * This constant stores the name to be given to the root query object.
     *
     * @var string
     */
    public const ROOT_QUERY_OBJECT_NAME = 'Root';

    /**
     * This constant stores the name of the object name in the API definition.
     *
     * @var string
     */
    protected const OBJECT_NAME = '';

    /**
     * SchemaObject constructor.
     */
    public function __construct(string $fieldName = '')
    {
        // Maintain backwards compatibility for generated RootQueryObjects by converting OBJECT_NAME 'query' to '' when encountered
        // TODO: Remove this when bumping up one major version
        $objectName = static::OBJECT_NAME === 'query' ? '' : static::OBJECT_NAME;
        $queryObject = !empty($fieldName) ? $fieldName : $objectName;
        parent::__construct($queryObject);
    }

    /**
     * @return $this
     */
    protected function appendArguments(array $arguments): QueryObject
    {
        foreach ($arguments as $argName => $argValue) {
            if ($argValue instanceof InputObject) {
                $argValue = $argValue->toRawObject();
            }

            $this->setArgument($argName, $argValue);
        }

        return $this;
    }

    public function getQuery(): Query
    {
        return parent::getQuery();
    }
}

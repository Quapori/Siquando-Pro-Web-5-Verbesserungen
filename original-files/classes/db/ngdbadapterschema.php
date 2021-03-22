<?php

/**
 *
 * Loads a NGDBSchemaSchema from XML
 *
 *
 */
class NGDBAdapterSchema
{

    const NodeTables = 'tables';
    const NodeTable = 'table';
    const NodeName = 'name';
    const NodeColumns = 'columns';
    const NodeColumn = 'column';
    const NodeKeys = 'keys';
    const NodeKey = 'key';
    const NodeType = 'type';
    const NodeSize = 'size';
    const NodeNull = 'null';
    const NodeDefault = 'default';
    const NodeAutoIncrement = 'autoincrement';
    const NodeDropTables = 'droptables';
    const NodeDropTable = 'droptable';
    const NodeVersion = 'version';

    /**
     *
     * Converts strings to column type
     * @var array
     */
    private $stringToColumnType = array(
        'int' => NGDBSchemaColumn::TypeInt,
        'float' => NGDBSchemaColumn::TypeFloat,
        'char' => NGDBSchemaColumn::TypeChar,
        'varchar' => NGDBSchemaColumn::TypeVarchar,
        'datetime' => NGDBSchemaColumn::TypeDateTime,
        'text' => NGDBSchemaColumn::TypeText
    );

    /**
     *
     * Converts string to key type
     * @var array
     */
    private $stringToKeyType = array(
        'key' => NGDBSchemaKey::typeKey,
        'fulltextkey' => NGDBSchemaKey::typeFulltextKey,
        'uniquekey' => NGDBSchemaKey::typeUniqueKey,
        'primarykey' => NGDBSchemaKey::typePrimaryKey
    );

    /**
     *
     * Load a schema from an XML node
     * @param DOMElement $schemaElement
     * @return NGDBSchemaSchema
     */
    public function loadSchema(DOMElement $schemaElement)
    {
        $schema = new NGDBSchemaSchema();

        foreach ($schemaElement->childNodes as $tablesElement) {
            /* @var $tablesElement DOMElement */
            if ($tablesElement->nodeType == XML_ELEMENT_NODE) {
                if ($tablesElement->nodeName == self::NodeTables) {
                    $schema->tables = $this->loadTables($tablesElement);
                }
                if ($tablesElement->nodeName == self::NodeDropTables) {
                    $schema->dropTables = $this->loadDropTables($tablesElement);
                }
            }
        }

        return $schema;
    }

    /**
     *
     * Loads tables from node
     * @param DOMElement $tablesElement tables node
     * @return array Array of NGDBSchemaTable
     */
    private function loadTables(DOMElement $tablesElement)
    {

        $tables = array();

        foreach ($tablesElement->childNodes as $tableElement) {
            /* @var $tableElement DOMElement */
            if ($tableElement->nodeType == XML_ELEMENT_NODE) {
                if ($tableElement->nodeName == self::NodeTable) {
                    $tables[] = $this->loadTable($tableElement);
                }
            }
        }

        return $tables;
    }

    /**
     *
     * Loads table from node
     * @param DOMElement $tableElement table node
     * @return NGDBSchemaTable
     */
    private function loadTable(DOMElement $tableElement)
    {

        $table = new NGDBSchemaTable();
        $table->name = $tableElement->getAttribute(self::NodeName);

        if ($tableElement->hasAttribute(self::NodeVersion)) $table->version=$tableElement->getAttribute(self::NodeVersion);

        foreach ($tableElement->childNodes as $columnsOrKeysNode) {
            /* @var $columnsOrKeysNode DOMElement */

            if ($columnsOrKeysNode->nodeType == XML_ELEMENT_NODE) {
                if ($columnsOrKeysNode->nodeName == self::NodeColumns) {
                    $table->columns = $this->loadColumns($columnsOrKeysNode);
                }
                if ($columnsOrKeysNode->nodeName == self::NodeKeys) {
                    $table->keys = $this->loadKeys($columnsOrKeysNode);
                }
            }
        }

        return $table;
    }

    /**
     * Loads columns from node
     * @param DOMElement $columnsElement
     * @return array Array of NGDBSchemaColumn
     */
    private function loadColumns(DOMElement $columnsElement)
    {
        $columns = array();

        foreach ($columnsElement->childNodes as $columnElement) {
            /* @var $columnElement DOMElement */
            if ($columnElement->nodeType == XML_ELEMENT_NODE) {
                if ($columnElement->nodeName == self::NodeColumn) {
                    $columns[] = $this->loadColumn($columnElement);
                }
            }
        }

        return $columns;
    }

    /**
     *
     * Loads Column from node
     * @param DOMElement $columnElement
     * @return NGDBSchemaColumn
     */
    private function loadColumn(DOMElement $columnElement)
    {
        $column = new NGDBSchemaColumn();

        $column->name = $columnElement->getAttribute(self::NodeName);
        $column->type = $this->stringToColumnType[$columnElement->getAttribute(self::NodeType)];

        if ($columnElement->hasAttribute(self::NodeSize)) $column->size = $columnElement->getAttribute(self::NodeSize);
        if ($columnElement->hasAttribute(self::NodeNull)) $column->null = $columnElement->getAttribute(self::NodeNull);
        if ($columnElement->hasAttribute(self::NodeDefault)) $column->default = $columnElement->getAttribute(self::NodeDefault);
        if ($columnElement->hasAttribute(self::NodeAutoIncrement)) $column->autoincrement = $columnElement->getAttribute(self::NodeAutoIncrement);
        if ($columnElement->hasAttribute(self::NodeVersion)) $column->version = $columnElement->getAttribute(self::NodeVersion);

        return $column;
    }

    /**
     *
     * Loads keys from node
     * @param DOMElement $keysElement
     * @return array Array of NGDBSchemaKey
     */
    private function loadKeys(DOMElement $keysElement)
    {
        $keys = array();

        foreach ($keysElement->childNodes as $keyElement) {
            /* @var $keyElement DOMElement */
            if ($keyElement->nodeType == XML_ELEMENT_NODE) {
                if ($keyElement->nodeName == self::NodeKey) {
                    $keys[] = $this->loadKey($keyElement);
                }
            }
        }

        return $keys;
    }

    /**
     *
     * Load key from node
     * @param DOMElement $keyElement
     * @return NGDBSchemaKey
     */
    private function loadKey(DOMElement $keyElement)
    {
        $key = new NGDBSchemaKey();

        if ($keyElement->hasAttribute(self::NodeName)) $key->name = $keyElement->getAttribute(self::NodeName);
        if ($keyElement->hasAttribute(self::NodeVersion)) $key->version = $keyElement->getAttribute(self::NodeVersion);
        $key->type = $this->stringToKeyType[$keyElement->getAttribute(self::NodeType)];

        foreach ($keyElement->childNodes as $columnsElement) {
            /* @var $columnsElement DOMElement */

            if ($columnsElement->nodeType == XML_ELEMENT_NODE) {
                if ($columnsElement->nodeName == self::NodeColumns) {
                    $key->columns = $this->loadKeyColumns($columnsElement);
                }
            }
        }

        return $key;
    }

    /**
     *
     * Loads key columns from node
     * @param DOMElement $keyColumnsElement
     * @return array Array of strings
     */
    private function loadKeyColumns(DOMElement $keyColumnsElement)
    {
        $keyColumns = array();

        foreach ($keyColumnsElement->childNodes as $keyColumnElement) {
            /* @var $keyColumnElement DOMElement */
            if ($keyColumnElement->nodeType == XML_ELEMENT_NODE) {
                if ($keyColumnElement->nodeName == self::NodeColumn) {
                    $keyColumns[] = $this->loadKeyColumn($keyColumnElement);
                }
            }
        }

        return $keyColumns;
    }

    /**
     *
     * Loads key column from node
     * @param DOMElement $keyColumnElement
     * @return string
     */
    private function loadKeyColumn(DOMElement $keyColumnElement)
    {
        return $keyColumnElement->nodeValue;
    }

    /**
     *
     * Loads droptables from node
     * @param DOMElement $tablesElement droptables node
     * @return array Array of NGDBSchemaDtopTable
     */
    private function loadDropTables(DOMElement $dropTablesElement)
    {

        $dropTables = array();

        foreach ($dropTablesElement->childNodes as $dropTableElement) {
            /* @var $dropTableElement DOMElement */
            if ($dropTableElement->nodeType == XML_ELEMENT_NODE) {
                if ($dropTableElement->nodeName == self::NodeDropTable) {
                    $dropTables[] = $this->loadDropTable($dropTableElement);
                }
            }
        }

        return $dropTables;
    }

    /**
     *
     * Loads droptable from node
     * @param DOMElement $dropTableElement
     * @return NGDBSchemaDropTable
     */
    private function loadDropTable(DOMElement $dropTableElement)
    {
        $dropTable = new NGDBSchemaDropTable();

        $dropTable->name = $dropTableElement->getAttribute(self::NodeName);

        if ($dropTableElement->hasAttribute(self::NodeVersion)) $dropTable->version=$dropTableElement->getAttribute(self::NodeVersion);

        return $dropTable;
    }


}

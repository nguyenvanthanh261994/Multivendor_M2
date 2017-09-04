<?php

namespace Magestore\Multivendor\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Magestore\Multivendor\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /*
         * Drop tables if exists
         */
        $installer->getConnection()->dropTable($installer->getTable('multivendor_vendor'));
        $installer->getConnection()->dropTable($installer->getTable('multivendor_vendor_product'));

        $table = $installer->getConnection()->newTable(
            $installer->getTable('multivendor_vendor')
        )->addColumn(
            'vendor_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'vendor_id ID'
        )->addColumn(
            'vendor_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            30,
            ['nullable' => false, 'default' => ''],
            'Vendor Code'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => false, 'default' => ''],
            'Name'
        )->addColumn(
            'description',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Description'
        )->addColumn(
            'logo',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Logo'
        )->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            ['nullable' => true],
            'Created At'
        )->addColumn(
            'updated_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            ['nullable' => true],
            'updated_at'
        )->addColumn(
            'address',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => false, 'default' => ''],
            'Address'
        )->addColumn(
            'phone',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => false, 'default' => ''],
            'Phone'
        )->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1'],
            'Options'
        );


        $installer->getConnection()->createTable($table);

        $table = $installer->getConnection()->newTable(
            $installer->getTable('multivendor_vendor_product')
        )->addColumn(
            'vendor_product_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'vendor_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Vendor Id'
        )->addColumn(
            'product_ids',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Product Ids'
        )->addForeignKey(
            $installer->getFkName(
                'multivendor_vendor_product',
                'vendor_id',
                'multivendor_vendor',
                'vendor_id'
            ),
            'vendor_id',
            $installer->getTable('multivendor_vendor'),
            'vendor_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        );


        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}

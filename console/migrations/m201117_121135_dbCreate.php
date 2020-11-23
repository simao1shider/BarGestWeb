<?php

use yii\db\Migration;

/**
 * Class m201117_121135_dbCreate
 */
class m201117_121135_dbCreate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('employee', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'phone' => $this->integer()->unique(),
            'birthDate' => $this->date(),
            'phone' => $this->integer(),
        ], $tableOptions);

        $this->createTable('table', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->notNull(),
        ], $tableOptions);

        $this->createTable('cashier', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'status' => $this->tinyInteger()->notNull(),
            'total' => $this->decimal(6,2)->notNull(),
        ], $tableOptions);

        $this->createTable('account', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'dateTime' => $this->dateTime()->notNull(),
            'nif' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->notNull(),
            'total' => $this->decimal(6,2)->notNull(),
            'table_id' => $this->integer(),
            'cashier_id' => $this->integer(),
        ], $tableOptions);

        $this->createTable('request', [
            'id' => $this->primaryKey(),
            'dateTime' => $this->dateTime()->notNull(),
            'status' => $this->tinyInteger()->notNull(),
            'account_id' => $this->integer(),
            'employee_id' => $this->integer(),
        ], $tableOptions);

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('iva', [
            'id' => $this->primaryKey(),
            'rate' => $this->integer()->unique(),
        ], $tableOptions);

        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal(6,2)->notNull(),
            'profit_margin' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'iva_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('products_to_be_paid', [
            'quantity' => $this->integer()->notNull(),
            'request_id' => $this->integer(),
            'product_id' => $this->integer(),
        ], $tableOptions);

        $this->createTable('products_paid', [
            'quantity' => $this->integer()->notNull(),
            'request_id' => $this->integer(),
            'product_id' => $this->integer(),
        ], $tableOptions);

        $this->addPrimaryKey('products_to_be_paid_pk', 'products_to_be_paid', ['request_id', 'product_id']);
        $this->addPrimaryKey('products_paid_pk', 'products_paid', ['request_id', 'product_id']);

        $this->createIndex(
            'idx-account-table_id',
            'account',
            'table_id'
        );

        // add foreign key for table `table`
        $this->addForeignKey(
            'fk-account-table_id',
            'account',
            'table_id',
            'table',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-account-cashier_id',
            'account',
            'cashier_id'
        );

        // add foreign key for table `cashier`
        $this->addForeignKey(
            'fk-account-cashier_id',
            'account',
            'cashier_id',
            'cashier',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-request-account_id',
            'request',
            'account_id'
        );

        // add foreign key for table `table`
        $this->addForeignKey(
            'fk-request-account_id',
            'request',
            'account_id',
            'account',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-request-employee_id',
            'request',
            'employee_id'
        );

        // add foreign key for table `table`
        $this->addForeignKey(
            'fk-request-employee_id',
            'request',
            'employee_id',
            'employee',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product-category_id',
            'product',
            'category_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product-iva_id',
            'product',
            'iva_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product-iva_id',
            'product',
            'iva_id',
            'iva',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-products_to_be_paid-product_id',
            'products_to_be_paid',
            'product_id'
        );

        // add foreign key for table `products_to_be_paid`
        $this->addForeignKey(
            'fk-products_to_be_paid-product_id',
            'products_to_be_paid',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-products_to_be_paid-request_id',
            'products_to_be_paid',
            'request_id'
        );

        // add foreign key for table `products_to_be_paid`
        $this->addForeignKey(
            'fk-products_to_be_paid-request_id',
            'products_to_be_paid',
            'request_id',
            'request',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-products_paid-product_id',
            'products_paid',
            'product_id'
        );

        // add foreign key for table `products_paid`
        $this->addForeignKey(
            'fk-products_paid-product_id',
            'products_paid',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-products_paid-request_id',
            'products_paid',
            'request_id'
        );

        // add foreign key for table `products_paid`
        $this->addForeignKey(
            'fk-products_paid-request_id',
            'products_paid',
            'request_id',
            'request',
            'id',
            'CASCADE'
        );
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201117_121135_dbCreate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201117_121135_dbCreate cannot be reverted.\n";

        return false;
    }
    */
}

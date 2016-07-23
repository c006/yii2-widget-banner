<?php
use yii\db\Migration;

class m000000_000000_c006_banner extends Migration
{

    /**
     *  ~ Console command ~
     *
     * php yii migrate --migrationPath=@vendor/c006/yii2-widget-banner/migrations
     *
     */
    /**
     *
     */
    public function up()
    {
        self::down();
        $tables              = Yii::$app->db->schema->getTableNames();
        $dbType              = $this->db->driverName;
        $tableOptions_mysql  = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        $tableOptions_mssql  = "";
        $tableOptions_pgsql  = "";
        $tableOptions_sqlite = "";
        /* MYSQL */
        if (!in_array('widget_banner', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%widget_banner}}', [
                    'id'                 => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0                    => 'PRIMARY KEY (`id`)',
                    'transition_id'      => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'transition_type_id' => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'name'               => 'VARCHAR(100) NOT NULL',
                    'transition_time'    => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'active'             => 'TINYINT(1) NULL',
                    'css'                => 'TEXT NULL',
                ], $tableOptions_mysql);
            }
        }
        /* MYSQL */
        if (!in_array('widget_banner_files', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%widget_banner_files}}', [
                    'id'     => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0        => 'PRIMARY KEY (`id`)',
                    'name'   => 'VARCHAR(100) NULL',
                    'file'   => 'VARCHAR(45) NULL',
                    'width'  => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'height' => 'SMALLINT(5) UNSIGNED NOT NULL',
                ], $tableOptions_mysql);
            }
        }
        /* MYSQL */
        if (!in_array('widget_banner_items', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%widget_banner_items}}', [
                    'id'              => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0                 => 'PRIMARY KEY (`id`)',
                    'banner_id'       => 'SMALLINT(6) NOT NULL',
                    'name'            => 'VARCHAR(100) NOT NULL',
                    'url'             => 'VARCHAR(100) NULL',
                    'date_start'      => 'INT(11) NOT NULL',
                    'date_start_hour' => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'date_end'        => 'INT(11) NOT NULL',
                    'date_end_hour'   => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'file_id'         => 'SMALLINT(6) NOT NULL',
                    'alt_text'        => 'VARCHAR(500) NULL',
                    'pause'           => 'SMALLINT(5) UNSIGNED NOT NULL DEFAULT \'10000\'',
                ], $tableOptions_mysql);
            }
        }
        /* MYSQL */
        if (!in_array('widget_banner_transition_types', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%widget_banner_transition_types}}', [
                    'id'   => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0      => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(45) NOT NULL',
                ], $tableOptions_mysql);
            }
        }
        /* MYSQL */
        if (!in_array('widget_banner_transitions', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%widget_banner_transitions}}', [
                    'id'   => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0      => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(45) NOT NULL',
                ], $tableOptions_mysql);
            }
        }
        $this->createIndex('idx_transition_id_8635_00', 'widget_banner', 'transition_id', 0);
        $this->createIndex('idx_transition_type_id_8635_01', 'widget_banner', 'transition_type_id', 0);
        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('fk_widget_banner_transitions_8631_00', '{{%widget_banner}}', 'transition_id', '{{%widget_banner_transitions}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_widget_banner_transition_types_8631_01', '{{%widget_banner}}', 'transition_type_id', '{{%widget_banner_transition_types}}', 'id', 'CASCADE', 'NO ACTION');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->insert('{{%widget_banner}}', ['id' => '1', 'transition_id' => '1', 'transition_type_id' => '1', 'name' => 'Home Main', 'transition_time' => '1500', 'active' => '1', 'css' => '.WidgetBanner {
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
}']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '1', 'name' => 'linear']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '2', 'name' => 'swing']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '3', 'name' => 'easeInQuad']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '4', 'name' => 'easeOutQuad']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '5', 'name' => 'easeInOutQuad']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '6', 'name' => 'easeInCubic']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '7', 'name' => 'easeOutCubic']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '8', 'name' => 'easeInOutCubic']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '9', 'name' => 'easeInQuart']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '10', 'name' => 'easeOutQuart']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '11', 'name' => 'easeInOutQuart']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '12', 'name' => 'easeInQuint']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '13', 'name' => 'easeOutQuint']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '14', 'name' => 'easeInOutQuint']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '15', 'name' => 'easeInExpo']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '16', 'name' => 'easeOutExpo']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '17', 'name' => 'easeInOutExpo']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '18', 'name' => 'easeInSine']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '19', 'name' => 'easeOutSine']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '20', 'name' => 'easeInOutSine']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '21', 'name' => 'easeInCirc']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '22', 'name' => 'easeOutCirc']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '23', 'name' => 'easeInOutCirc']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '24', 'name' => 'easeInElastic']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '25', 'name' => 'easeOutElastic']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '26', 'name' => 'easeInOutElastic']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '27', 'name' => 'easeInBack']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '28', 'name' => 'easeOutBack']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '29', 'name' => 'easeInOutBack']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '30', 'name' => 'easeInBounce']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '31', 'name' => 'easeOutBounce']);
        $this->insert('{{%widget_banner_transition_types}}', ['id' => '32', 'name' => 'easeInOutBounce']);
        $this->insert('{{%widget_banner_transitions}}', ['id' => '1', 'name' => 'Fade']);
        $this->insert('{{%widget_banner_transitions}}', ['id' => '2', 'name' => 'Slide Left']);
        $this->insert('{{%widget_banner_transitions}}', ['id' => '3', 'name' => 'Slide Right']);
        $this->execute('SET foreign_key_checks = 1;');
        echo PHP_EOL;
        echo PHP_EOL;
        echo "*** Remember to setup images folder ***" . PHP_EOL;
        echo "[root]/frontend/web/images/widget/banner";
        echo PHP_EOL;
        echo PHP_EOL;

    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `widget_banner`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `widget_banner_files`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `widget_banner_items`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `widget_banner_transition_types`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `widget_banner_transitions`');
        $this->execute('SET foreign_key_checks = 1;');
    }
}


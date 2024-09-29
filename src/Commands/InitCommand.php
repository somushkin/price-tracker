<?php

namespace App\Commands;

class InitCommand extends BaseCommand
{
    public function __invoke($arg = ''): void
    {
        $this->createTables();
    }

    private function createTables(): void
    {
        $this->db->createTable('subscribers', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`)',
            'email' => 'VARCHAR(255) NOT NULL UNIQUE',
            'is_verified' => 'INT(1) NOT NULL DEFAULT 0',
            'verification_code' => 'VARCHAR(255) DEFAULT NULL',
        ]);
        $this->db->createTable('links', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`)',
            'url' => 'VARCHAR(255) NOT NULL UNIQUE',
            'product_id' => 'BIGINT(11) UNSIGNED NOT NULL UNIQUE',
            'product_price' => 'DECIMAL(10, 2) NOT NULL DEFAULT 0.00',
        ]);
        $this->db->createTable('links_subscribers', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`)',
            'link_id' => 'INT(11) UNSIGNED NOT NULL ',
            'subscriber_id' => 'INT(11) UNSIGNED NOT NULL',
        ]);
    }
}
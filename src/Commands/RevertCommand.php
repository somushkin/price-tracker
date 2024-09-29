<?php

namespace App\Commands;

class RevertCommand extends BaseCommand
{
    public function __invoke($arg = ''): void
    {
        $this->db->dropTableIfExists('subscribers');
        $this->db->dropTableIfExists('links');
        $this->db->dropTableIfExists('links_subscribers');
    }
}
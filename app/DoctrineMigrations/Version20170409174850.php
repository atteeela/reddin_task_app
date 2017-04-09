<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Create users table
 */
class Version20170409174850 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('
                      CREATE TABLE users 
                      (
                        id INT NOT NULL AUTO_INCREMENT,
                        first_name VARCHAR(255) NOT NULL, 
                        last_name VARCHAR(255) NOT NULL, 
                        is_active TINYINT NOT NULL, 
                        email VARCHAR(255) NOT NULL, 
                        password VARCHAR(255) NOT NULL, 
                        PRIMARY KEY(id),
                        UNIQUE KEY(email)
                      ) ENGINE = InnoDB

        ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE users');
    }
}

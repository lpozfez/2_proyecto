<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230129115759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juego (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, editorial VARCHAR(150) NOT NULL, min_jugadores INT NOT NULL, max_jugadores INT NOT NULL, ancho_tablero NUMERIC(5, 2) NOT NULL, alto_tablero NUMERIC(5, 2) NOT NULL, imagen VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mesa (id INT AUTO_INCREMENT NOT NULL, ancho NUMERIC(5, 2) NOT NULL, alto NUMERIC(5, 2) NOT NULL, x NUMERIC(5, 2) NOT NULL, y NUMERIC(5, 2) DEFAULT NULL, imagen VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, apellidos VARCHAR(150) NOT NULL, nickname VARCHAR(50) NOT NULL, email VARCHAR(260) NOT NULL, contraseña VARCHAR(10) NOT NULL, rol VARCHAR(5) NOT NULL, telegram VARCHAR(32) DEFAULT NULL, puntos INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE juego');
        $this->addSql('DROP TABLE mesa');
        $this->addSql('DROP TABLE user');
    }
}

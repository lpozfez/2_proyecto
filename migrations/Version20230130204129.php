<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130204129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evento_presenta_juego (id INT AUTO_INCREMENT NOT NULL, evento_id INT NOT NULL, juego_id INT NOT NULL, UNIQUE INDEX UNIQ_BF5D10C087A5F842 (evento_id), INDEX IDX_BF5D10C013375255 (juego_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invitacion (id INT AUTO_INCREMENT NOT NULL, socio_id INT NOT NULL, evento_id INT NOT NULL, INDEX IDX_3CD30E84DA04E6A9 (socio_id), UNIQUE INDEX UNIQ_3CD30E8487A5F842 (evento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tramo (id INT AUTO_INCREMENT NOT NULL, hora TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evento_presenta_juego ADD CONSTRAINT FK_BF5D10C087A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
        $this->addSql('ALTER TABLE evento_presenta_juego ADD CONSTRAINT FK_BF5D10C013375255 FOREIGN KEY (juego_id) REFERENCES juego (id)');
        $this->addSql('ALTER TABLE invitacion ADD CONSTRAINT FK_3CD30E84DA04E6A9 FOREIGN KEY (socio_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE invitacion ADD CONSTRAINT FK_3CD30E8487A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
        $this->addSql('ALTER TABLE reserva ADD tramo_id INT NOT NULL');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B6E801575 FOREIGN KEY (tramo_id) REFERENCES tramo (id)');
        $this->addSql('CREATE INDEX IDX_188D2E3B6E801575 ON reserva (tramo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B6E801575');
        $this->addSql('ALTER TABLE evento_presenta_juego DROP FOREIGN KEY FK_BF5D10C087A5F842');
        $this->addSql('ALTER TABLE evento_presenta_juego DROP FOREIGN KEY FK_BF5D10C013375255');
        $this->addSql('ALTER TABLE invitacion DROP FOREIGN KEY FK_3CD30E84DA04E6A9');
        $this->addSql('ALTER TABLE invitacion DROP FOREIGN KEY FK_3CD30E8487A5F842');
        $this->addSql('DROP TABLE evento_presenta_juego');
        $this->addSql('DROP TABLE invitacion');
        $this->addSql('DROP TABLE tramo');
        $this->addSql('DROP INDEX IDX_188D2E3B6E801575 ON reserva');
        $this->addSql('ALTER TABLE reserva DROP tramo_id');
    }
}

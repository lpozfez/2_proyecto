<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130195940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva ADD socio_id INT NOT NULL, ADD juego_id INT NOT NULL, ADD mesa_id INT NOT NULL, ADD asiste TINYINT(1) DEFAULT NULL, ADD cancelacion TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BDA04E6A9 FOREIGN KEY (socio_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B13375255 FOREIGN KEY (juego_id) REFERENCES juego (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B8BDC7AE9 FOREIGN KEY (mesa_id) REFERENCES mesa (id)');
        $this->addSql('CREATE INDEX IDX_188D2E3BDA04E6A9 ON reserva (socio_id)');
        $this->addSql('CREATE INDEX IDX_188D2E3B13375255 ON reserva (juego_id)');
        $this->addSql('CREATE INDEX IDX_188D2E3B8BDC7AE9 ON reserva (mesa_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BDA04E6A9');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B13375255');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B8BDC7AE9');
        $this->addSql('DROP INDEX IDX_188D2E3BDA04E6A9 ON reserva');
        $this->addSql('DROP INDEX IDX_188D2E3B13375255 ON reserva');
        $this->addSql('DROP INDEX IDX_188D2E3B8BDC7AE9 ON reserva');
        $this->addSql('ALTER TABLE reserva DROP socio_id, DROP juego_id, DROP mesa_id, DROP asiste, DROP cancelacion');
    }
}

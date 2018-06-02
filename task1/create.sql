-- -----------------------------------------------------
-- Schema library_data_base
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `library_data_base` DEFAULT CHARACTER SET utf8 ;
USE `library_data_base` ;

-- -----------------------------------------------------
-- Table `library_data_base`.`author`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_data_base`.`author` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(155) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idauthor_UNIQUE` (`id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `library_data_base`.`book`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_data_base`.`book` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `year` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `library_data_base`.`book_has_author`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_data_base`.`book_has_author` (
  `book_id` INT(11) NOT NULL,
  `author_id` INT(11) NOT NULL,
  PRIMARY KEY (`book_id`, `author_id`),
  INDEX `fk_book_has_author_author1_idx` (`author_id` ASC),
  INDEX `fk_book_has_author_book_idx` (`book_id` ASC),
  CONSTRAINT `fk_book_has_author_book`
    FOREIGN KEY (`book_id`)
    REFERENCES `library_data_base`.`book` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_book_has_author_author1`
    FOREIGN KEY (`author_id`)
    REFERENCES `library_data_base`.`author` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
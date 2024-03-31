CREATE TABLE IF NOT EXISTS `dinobookstore`.`books` (
  `ISBN`        VARCHAR(17) NOT NULL,
  `title`       VARCHAR(64) NOT NULL,
  `author`      VARCHAR(64)     NULL DEFAULT 'Anonymous',
  `description` TEXT            NULL,
  `price`       DECIMAL(10,2)   NULL DEFAULT '0.0',
  `year`        YEAR        NOT NULL,
  `cover_url`   VARCHAR(255)    NULL DEFAULT 'defaultcover.svg',
  `status`      BOOLEAN         NULL DEFAULT TRUE,
  PRIMARY KEY (`ISBN`),
  UNIQUE (`title`)
) ENGINE = InnoDB;
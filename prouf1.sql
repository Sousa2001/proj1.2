/*CREATE TABLE `roles` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`role` varchar(100) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
);*/

CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`email` varchar(100) NOT NULL UNIQUE,
	`uname` varchar(100) NOT NULL UNIQUE,
	`passwd` varchar(100) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `task` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(255) NOT NULL,
	`user` VARCHAR(200) NOT NULL,
	`due_date` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

/*CREATE TABLE `task_item` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`item` VARCHAR(255) NOT NULL,
	`completed` BOOLEAN NOT NULL,
	`task` INT NOT NULL,
	PRIMARY KEY (`id`)
);*/

/*ALTER TABLE `users` ADD CONSTRAINT `users_fk0` FOREIGN KEY (`role`) REFERENCES `roles`(`id`);*/

ALTER TABLE `task` ADD CONSTRAINT `task_fk0` FOREIGN KEY (`user`) REFERENCES `users`(`id`);

/*ALTER TABLE `task_item` ADD CONSTRAINT `task_item_fk0` FOREIGN KEY (`task`) REFERENCES `task`(`id`);*/


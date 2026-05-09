CREATE TABLE `tasks` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`task_name` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`description` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`priority` ENUM('Urgent and Important','Important but Not Urgent','Urgent but Not Important','Not Urgent or Important') NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`deadline` DATE NOT NULL,
	`status` ENUM('todo','in_progress','completed','submitted') NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
AUTO_INCREMENT=21
;

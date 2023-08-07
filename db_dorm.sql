/*Table structure for table `bookings` */

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dorm` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `length_of_stay` int(11) DEFAULT NULL,
  `current_payment` int(11) DEFAULT NULL,
  `total_payment` int(11) DEFAULT NULL,
  `status` enum('paid','unpaid','outstanding','close') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bookings` */

insert  into `bookings`(`id`,`id_dorm`,`id_room`,`id_customer`,`code`,`start_date`,`end_date`,`length_of_stay`,`current_payment`,`total_payment`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(20,1,1,12,'20230803082844','2023-08-03 00:00:00','2023-04-25 12:30:00',1,500000,1000000,'outstanding','2023-08-03 08:28:44','2023-08-03 08:28:44',1,1),
(21,2,5,12,'20230803082906','2023-08-03 00:00:00','2023-04-25 12:30:00',1,1500000,1500000,'paid','2023-08-03 08:29:06','2023-08-03 08:29:06',1,1),
(22,3,8,12,'20230803124925','2023-08-06 00:00:00','2023-04-25 12:30:00',12,24000000,24000000,'paid','2023-08-03 12:49:25','2023-08-03 12:50:23',1,1),
(23,3,15,12,'20230807044252','2023-08-07 00:00:00','2023-04-25 12:30:00',3,1000000,6000000,'outstanding','2023-08-07 04:42:52','2023-08-07 04:42:52',1,1);

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `phone_emergency` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_st` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`nik`,`name`,`phone`,`address`,`gender`,`photo`,`phone_emergency`,`created_at`,`updated_st`) values 
(12,'3211021205960004','Achmad Wahyudi','081324064286','dusun bojongjati rt.04 rw.01 desa tarikolot kec. jatinunggal                               ','L',NULL,'081290200887',NULL,NULL);

/*Table structure for table `dorms` */

DROP TABLE IF EXISTS `dorms`;

CREATE TABLE `dorms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `dorms` */

insert  into `dorms`(`id`,`name`,`phone`,`address`,`created_at`,`updated_at`) values 
(1,'Graha 9\n',NULL,NULL,NULL,NULL),
(2,'Griya 99\n',NULL,NULL,NULL,NULL),
(3,'Griya Salam\n',NULL,NULL,NULL,NULL);

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `logs` */

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_booking` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `evidance` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `payments` */

insert  into `payments`(`id`,`id_booking`,`code`,`amount`,`description`,`evidance`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(8,20,'TRX-20230803082844',500000,'pembayaran DP',NULL,'2023-08-03 08:28:44','2023-08-03 08:28:44',1,1),
(9,21,'TRX-20230803082906',1500000,'pembayaran DP',NULL,'2023-08-03 08:29:06','2023-08-03 08:29:06',1,1),
(10,22,'TRX-20230803124925',500000,'pembayaran DP',NULL,'2023-08-03 12:49:25','2023-08-03 12:49:25',1,1),
(11,2147483647,'TRX-20230803125023',23500000,'-',NULL,'2023-08-03 12:50:23','2023-08-03 12:50:23',1,1),
(12,23,'TRX-20230807044252',1000000,'pembayaran DP',NULL,'2023-08-07 04:42:52','2023-08-07 04:42:52',1,1);

/*Table structure for table `rooms` */

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dorm` int(11) DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `down_payment` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `rooms` */

insert  into `rooms`(`id`,`id_dorm`,`floor`,`name`,`description`,`price`,`down_payment`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,1,1,'A',NULL,1000000,500000,NULL,NULL,NULL,NULL),
(5,2,1,'A','                                            ',1500000,500000,NULL,NULL,NULL,NULL),
(8,3,1,'A','                                            ',2000000,500000,NULL,NULL,NULL,NULL),
(15,3,1,'B','-',2000000,1000000,'2023-08-01 06:47:36','2023-08-01 06:47:36',1,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_active` varchar(1) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`level`,`name`,`is_active`,`photo`,`created_at`) values 
(1,'admin','$2y$10$CiBeF9W4QzVdyhN4hCjDw.I6HqDYWCyYpuPaQ2zm/YUI6kQcP5q1e','admin','Admin','Y',NULL,NULL);

/*Table structure for table `dorm_summary_room` */

DROP TABLE IF EXISTS `dorm_summary_room`;

/*!50001 DROP VIEW IF EXISTS `dorm_summary_room` */;
/*!50001 DROP TABLE IF EXISTS `dorm_summary_room` */;

/*!50001 CREATE TABLE  `dorm_summary_room`(
 `dorm_id` int(11) ,
 `dorm_name` varchar(100) ,
 `total_room` bigint(21) ,
 `total_room_used` bigint(21) ,
 `total_room_booked` bigint(21) ,
 `total_room_available` bigint(23) ,
 `occupancy` decimal(27,2) 
)*/;

/*View structure for view dorm_summary_room */

/*!50001 DROP TABLE IF EXISTS `dorm_summary_room` */;
/*!50001 DROP VIEW IF EXISTS `dorm_summary_room` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dorm_summary_room` AS (select `dorms`.`id` AS `dorm_id`,`dorms`.`name` AS `dorm_name`,count(`rooms`.`id`) AS `total_room`,count(case when `bookings`.`status` = 'paid' then `rooms`.`id` end) AS `total_room_used`,count(case when `bookings`.`status` = 'outstanding' then `rooms`.`id` end) AS `total_room_booked`,count(`rooms`.`id`) - (count(case when `bookings`.`status` = 'paid' then `rooms`.`id` end) + count(case when `bookings`.`status` = 'outstanding' then `rooms`.`id` end)) AS `total_room_available`,round((count(case when `bookings`.`status` = 'paid' then `rooms`.`id` end) + count(case when `bookings`.`status` = 'outstanding' then `rooms`.`id` end)) / count(`rooms`.`id`) * 100,2) AS `occupancy` from ((`dorms` left join `rooms` on(`dorms`.`id` = `rooms`.`id_dorm`)) left join `bookings` on(`rooms`.`id` = `bookings`.`id_room`)) group by `dorms`.`id`,`dorms`.`name`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

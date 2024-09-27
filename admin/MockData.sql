CREATE Database market;

USE market;

CREATE TABLE categories (
  id int NOT NULL,
  name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  tr int NOT NULL,
  active tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO categories (id, name, tr, active) VALUES
(3, 'Qishki kiyimlar', 1, 1),
(4, 'Oziq-ovqat mahsulotlari', 2, 1),
(5, 'Texnika', 3, 1);


CREATE TABLE products (
  id int NOT NULL,
  user_id int NOT NULL,
  category_id int NOT NULL,
  name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  price decimal(10,2) NOT NULL,
  photo varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  count int NOT NULL,
  premium int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO products (id, user_id, category_id, name, price, photo, count, premium) VALUES
(15, 1, 4, 'Non', 4000.00, 'img/25. Ромашки', 500, 0),
(16, 1, 5, 'Samsung 24ultra', 14000000.00, 'img/19. Самолеты', 12, 1),
(17, 2, 5, 'BMW M5 F90 Competition', 110000.00, 'img/20. Карандаши', 1, 1),
(18, 2, 5, 'Iphone 16 Pro Max', 23000000.00, 'img/15-inch-MacBook-Air-wallpaper-3.webp', 12, 1);


CREATE TABLE users (
  id int NOT NULL,
  name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  email varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  password varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  role varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO users (id, name, email, password, role) VALUES
(1, 'Tojinazarov Sirojiddin', 'sirojiddintojinazarov59@gmail.com', '$2y$10$wbcRVacJGXSTx7ExVG93teE1oTWUOmfwYFbbjCIUKTzwmPD.wnzSW', 'admin'),
(2, 'Alisher', 'alisher@gmail.com', '$2y$10$6Yfr5VxgI8xvDGx54F6xE.UCvKN9kktfDPJttAd/oCZ9UyAy5kysS', 'user');

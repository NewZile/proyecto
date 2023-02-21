-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2023 a las 13:38:17
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `php_login_base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(21, 'rauldelarosa815@gmail.com', '$2y$10$HNnLE1kTJ5YirEdEFMbXTOPmvVXBno2hJMmjtfLVOiXO6RZUQBxuu'),
(22, 'rauldelarosariquelme@hotmail.com', '$2y$10$2eyoRKbAte8MlSRM2d3Xsetu5ZBFAJo5MzclTue/D52MLr9ngneSW'),
(23, 'nfjdinfidsn@gmail.com', '$2y$10$QFYYjbTpdRg6LrCgas0hP.46LgZda5ApTCgMgpoitACcT8/HUbnVC'),
(24, 'rauldelarosa815@gmail.com', '$2y$10$Pwhf7PIdfOJJ.jwp8GIK/.1jvBbXdVnXA5H0wvI1/JyLKsrd6LZn2'),
(25, 'rauldelarosa815@gmail.com', '$2y$10$0B8wj.N/s7Hbw1csEQFwputuFfTIcdK4sAQEesqOLyN2RjjHquzam'),
(26, 'rauldelarosa815@gmail.com', '$2y$10$RPfetih5mXoUwnbO2xg8nuKyQxaFUYF1ljKUbBevnt9o3kT4AGIjq'),
(27, 'rauldelarosa815@gmail.com', '$2y$10$RjpF7AgKfyqdUnqcJop8N.j1eGOga1wKS8QE91CMrOATpCkBRuBdu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;
BEGIN TRANSACTION;
DROP TABLE IF EXISTS `pedidos_error`;
CREATE TABLE IF NOT EXISTS `pedidos_error` (
	`idPedido`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`item`	INTEGER NOT NULL,
	`descripcion`	TEXT NOT NULL,
	`monto`	NUMERIC,
	`codigo_error`	TEXT,
	`fecha_pedido`	TEXT,
	`email`	TEXT,
	`fecha_creacion`	TEXT,
	`ip`	TEXT NOT NULL
);
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
	`idPedido`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`item`	INTEGER NOT NULL,
	`descripcion`	TEXT NOT NULL,
	`monto`	NUMERIC,
	`codigo_referencia`	TEXT,
	`codigo_autorizacion`	TEXT,
	`fecha_pedido`	TEXT,
	`email`	TEXT,
	`fecha_creacion`	TEXT,
	`ip`	TEXT NOT NULL
);
COMMIT;

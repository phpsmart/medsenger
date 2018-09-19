DROP SCHEMA IF EXISTS angular CASCADE;

CREATE SCHEMA angular;

DROP TABLE IF exists angular.message;

DROP SEQUENCE IF EXISTS angular.message_id_seq;

CREATE SEQUENCE angular.message_id_seq START 100;

CREATE TABLE angular.message (
	id          int default nextval('angular.message_id_seq') constraint pk_message$id PRIMARY key ,	
	name        VARCHAR(200) NOT null,
	remote_addr VARCHAR(20),
	created_at  timestamp with time zone not null default now(),
	updated_at  timestamp with time zone not null default now(),
	show        boolean default true
);

INSERT INTO angular.message (name, remote_addr, show) 
VALUES 
    ('Равным образом, реализация намеченных плановых заданий является качественно новой ступенью.', '5.188.232.240', TRUE),
	('Повседневная практика показывает, что новая модель говорит о возможностях политик.', '5.188.232.240', TRUE),
	('Участники технического прогресса заблокированы в рамках своих собственных ограничений', '5.188.232.240', TRUE),
	('Элементы политического процесса могут быть ассоциативно распределены по отраслям.', '5.188.232.240', TRUE),
	('Дальнейшее развитие различных форм деятельности способствует подготовке и реализации анализа.', '5.188.232.240', TRUE),
	('Высокое качество исследований создает необходимость включения в план целого мероприятий.', '5.188.232.240', TRUE),
	('Задача организации влечет за собой процесс внедрения и обновления благоприятных перспектив.', '5.188.232.240', TRUE)
	;
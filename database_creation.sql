CREATE TABLE IF NOT EXISTS users
(
    id            int primary key,
    lastname      varchar(80) not null,
    name          varchar(80) not null,
    birthdate     date        not null,
    email         varchar(80) not null,
    creation_date date        not null
);

CREATE TABLE IF NOT EXISTS expense_report
(
    id            int primary key,
    amount        float       not null,
    type          varchar(80) not null,
    payment_date  date        not null,
    creation_date date        not null
);

CREATE TABLE IF NOT EXISTS company
(
    id            int primary key,
    name          varchar(80) not null,
    email         varchar(80) not null,
    creation_date date        not null
);
CREATE TABLE IF NOT EXISTS "user"
(
    id            serial primary key,
    lastname      varchar(80)        not null,
    name          varchar(80)        not null,
    birthdate     date               not null,
    email         varchar(80) unique not null,
    creation_date timestamp          not null
);

CREATE UNIQUE INDEX user_idx ON "user" (id);

CREATE TABLE IF NOT EXISTS expense_report
(
    id            serial primary key,
    amount        float       not null,
    type          varchar(80) not null,
    payment_date  date        not null,
    company       int         not null,
    "user"          int         not null,
    creation_date timestamp   not null
);

CREATE UNIQUE INDEX expense_report_idx ON "expense_report" (id);
CREATE UNIQUE INDEX expense_report_company_idx ON expense_report (company);
CREATE UNIQUE INDEX expense_report_user_idx ON "expense_report" ("user");

CREATE TABLE IF NOT EXISTS company
(
    id            serial primary key,
    name          varchar(80) not null,
    email         varchar(80) not null,
    creation_date timestamp   not null
);

CREATE UNIQUE INDEX commpany_idx ON "company" (id);
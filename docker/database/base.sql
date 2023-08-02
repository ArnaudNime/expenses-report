CREATE TABLE IF NOT EXISTS commercial
(
    id            serial primary key,
    lastname      varchar(80)        not null,
    name          varchar(80)        not null,
    birthdate     date               not null,
    email         varchar(80) unique not null,
    creation_date timestamp          not null
);

CREATE TABLE IF NOT EXISTS expense_report
(
    id            serial primary key,
    amount        float       not null,
    type          varchar(80) not null,
    payment_date  date        not null,
    company       int         not null,
    commercial        int         not null,
    creation_date timestamp   not null
);

CREATE INDEX expense_report_company_idx ON expense_report (company);
CREATE INDEX expense_report_user_idx ON "expense_report" ("commercial");

CREATE TABLE IF NOT EXISTS company
(
    id            serial primary key,
    name          varchar(80) not null,
    email         varchar(80) not null,
    creation_date timestamp   not null
);

CREATE TABLE IF NOT EXISTS commercial
(
    id            serial primary key,
    firstname     varchar(80)        not null,
    lastname      varchar(80)        not null,
    birthdate     date               not null,
    email         varchar(80) unique not null,
    creation_date timestamp          not null
);

CREATE TABLE IF NOT EXISTS company
(
    id            serial primary key,
    name          varchar(80) unique not null,
    email         varchar(80) unique not null,
    creation_date timestamp          not null
);

CREATE TABLE IF NOT EXISTS expense_report
(
    id            serial primary key,
    amount        float       not null,
    type          varchar(80) not null,
    payment_date  date        not null,
    company_id    int         not null,
    commercial_id int         not null,
    creation_date timestamp   not null
);

ALTER TABLE expense_report
    ADD CONSTRAINT company_fk
        FOREIGN KEY (company_id) REFERENCES company(id);

ALTER TABLE expense_report
    ADD CONSTRAINT commercial_fk
        FOREIGN KEY (commercial_id) REFERENCES commercial(id);

CREATE INDEX expense_report_company_idx ON expense_report (company_id);
CREATE INDEX expense_report_user_idx ON "expense_report" ("company_id");

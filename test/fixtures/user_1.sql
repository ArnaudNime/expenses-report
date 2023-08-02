/* user */
INSERT INTO "user" (id, lastname, name, birthdate, email, creation_date)
VALUES (1, 'Jean', 'Tam', '2002-05-17', 'jean.tam@ledev.eu', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
/* company */
INSERT INTO company (id, name, email, creation_date)
VALUES (1, 'jules', 'contact@jules.com', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO company (id, name, email, creation_date)
VALUES (2, 'go sport', 'contact@gosport.com', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO company (id, name, email, creation_date)
VALUES (3, 'nocibe', 'nocibe@gosport.com', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO company (id, name, email, creation_date)
VALUES (4, 'carrefour', 'nocibe@carrefour.com', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
/* expense_report */
INSERT INTO expense_report (id, amount, type, company, "user", payment_date, creation_date)
VALUES (1, 100, 'gazoline', 1, 1, '2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (id, amount, type, company, "user", payment_date, creation_date)
VALUES (2, 15.50, 'meat', 1, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (id, amount, type, company, "user", payment_date, creation_date)
VALUES (3, 12.50, 'toll', 1, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (id, amount, type, company, "user", payment_date, creation_date)
VALUES (4, 1000, 'conference', 1, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;

INSERT INTO expense_report (id, amount, type, company, "user", payment_date, creation_date)
VALUES (5, 20, 'gazoline', 2, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (id, amount, type, company, "user", payment_date, creation_date)
VALUES (6, 22.50, 'meat', 2, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (id, amount, type, company, "user", payment_date, creation_date)
VALUES (7, 1.50, 'toll', 2, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (id, amount, type, company, "user", payment_date, creation_date)
VALUES (8, 1000, 'conference', 2, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
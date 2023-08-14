/* user */
INSERT INTO commercial (firstname, lastname, birthdate, email, creation_date)
VALUES ('Jean', 'Tam', '2002-05-17', 'jean.tam@ledev.eu', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
/* company */
INSERT INTO company (name, email, creation_date)
VALUES ('jules', 'contact@jules.com', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO company (name, email, creation_date)
VALUES ('go sport', 'contact@gosport.com', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO company (name, email, creation_date)
VALUES ('nocibe', 'contact@nocibe.com', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO company (name, email, creation_date)
VALUES ('carrefour', 'contact@carrefour.com', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
/* expense_report */
INSERT INTO expense_report (amount, type, company_id, commercial_id, payment_date, creation_date)
VALUES (100, 'gazoline', 1, 1, '2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (amount, type, company_id, commercial_id, payment_date, creation_date)
VALUES (15.50, 'meat', 1, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (amount, type, company_id, commercial_id, payment_date, creation_date)
VALUES (12.50, 'toll', 1, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (amount, type, company_id, commercial_id, payment_date, creation_date)
VALUES (1000, 'conference', 1, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;

INSERT INTO expense_report (amount, type, company_id, commercial_id, payment_date, creation_date)
VALUES (20, 'gazoline', 2, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (amount, type, company_id, commercial_id, payment_date, creation_date)
VALUES (22.50, 'meat', 2, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (amount, type, company_id, commercial_id, payment_date, creation_date)
VALUES (1.50, 'toll', 2, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
INSERT INTO expense_report (amount, type, company_id, commercial_id, payment_date, creation_date)
VALUES (1000, 'conference', 2, 1,'2023-08-02', '2023-08-02 20:30:10.000000')
ON CONFLICT DO NOTHING;
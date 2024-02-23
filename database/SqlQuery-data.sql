SET FOREIGN_KEY_CHECKS=0;

INSERT into budget(name)
VALUES
('Supplies Budget'),
('Domestics Budget'),
('Catering Budget'),
('Servicing Budget'),
('Repairs Budget');

INSERT into net_income(name)
VALUES
('Supplies Net Income'),
('Domestics Net Income'),
('Catering Net Income'),
('Servicing Net Income'),
('Repairs Net Income');

INSERT into department(budget_id, net_inc_id, name, address_1, address_2, postcode)
VALUES
(1, 1, 'Supplies', '12 Blyden Close', 'Hedgefield', 'HE14 8PN'),
(2, 2, 'Domestics', '12 Blyden Close', 'Hedgefield', 'HE14 8PN'),
(3, 3, 'Catering', '12 Blyden Close', 'Hedgefield', 'HE14 8PN'),
(4, 4, 'Servicing', '22 Roach Avenue', 'Hedgefield', 'HE14 6BL'),
(5, 5, 'Repairs', '22 Roach Avenue', 'Hedgefield', 'HE14 6BL'),
(6, 6, 'Administration', '08 Belle Road', 'Hedgefield', 'HE16 2CD');

INSERT INTO user(department_id, first_name, surname, dob, email, employee_type, locked, username, password)
VALUES
/* EMPLOYEES */
(1, 'Paul', 'Allen', '1963-08-11', 'paulallen@company.org.uk', 0, false, 'pallen', '123'),
(1, 'Mary', 'Grey', '1966-04-19', 'marygrey@company.org.uk', 0, false, 'mgrey', '123'),
(2, 'Robert', 'Fitzgerald', '1967-08-01', 'robertfitzgerald@company.org.uk', 0, false, 'rfitzgerald', '123'),
(2, 'Steve', 'Bowman', '1984-12-01', 'stevebowman@company.org.uk', 0, false, 'sbowman', '123'),
(3, 'Ralph', 'Delfino', '1975-11-05', 'ralphdelfino@company.org.uk', 0, false, 'rdelfino', '123'),
(4, 'Zoey', 'Chase', '2004-02-25', 'zoeychase@company.org.uk', 0, false, 'zchase', '123'),
(5, 'Laura', 'Lane', '2000-04-22', 'lauralane@company.org.uk', 0, false, 'llane', '123'),
/* MANAGERS */
(1, 'Sally', 'Peters', '1999-08-12', 'sallypeters@company.org.uk', 1, false, 'speters', '123'),
(2, 'Charles', 'Bale', '1997-10-24', 'charlesbale@company.org.uk', 1, false, 'cbale', '123'),
(3, 'Patrick', 'Schofield', '2002-03-16', 'patrickschofield@company.org.uk', 1, false, 'pschofield', '123'),
(4, 'Alice', 'Mercer', '1984-12-04', 'stevebowman@company.org.uk', 1, false, 'amercer', '123'),
(5, 'Adam', 'Reacher', '2000-02-09', 'adamreacher@company.org.uk', 1, false, 'areacher', '123'),
/* ADMINS */
(6, 'Sam', 'Richardson', '2001-05-01', 'samrichardson@company.org.uk', 2, false, 'srichardson', '123');

INSERT into expense_transaction(user_id, name, info, value)
VALUES
(1, 'Pencils', '25x pencils.', 5),
(1, 'Cleanup', 'Cleaning on floor 2.', 12.50),
(2, 'Erasers', '30x erasers.', 4.50),
(5,'Sandwhiches', '60x Sandwhiches for guests.', 50.25),
(5, 'Refereshment package', 'Standard refreshment package for guests.', 25.00),
(3, 'Office chair', 'replacement office chair.', 18.00),
(4, 'Table fan', 'standard office table fan.', 9.99);

INSERT into income_transaction(useR_id, name, info, value)
VALUES
(10, 'Cupcake x4', 'Multipack of cupcakes.', 3.99),
(10, 'Cupcake x1', 'Single cupcake.', 1.49),
(10, 'Cheeecake x1', 'Single cheesecake.', 1.99),
(10, 'Vending Machine Drink', 'A drinks item sold via vending machine.', 0.99),
(10, 'Vending Machine Snack', 'A snack item sold via vending machine.', 1.29),
(11, 'Standard service', '09AM slot service.', 75),
(11, 'Standard service', '10AM slot service.', 75),
(11, 'Deluxe service', '11AM slot service.', 125),
(11, 'Standard service', '13PM slot service.', 75),
(11, 'Standard service', '14PM slot service.', 75),
(11, 'Standard service', '15PM slot service.', 75),
(11, 'Standard service Discounted', '16PM slot service, discount voucher applied.', 60),
(12, 'Windscreen wipers', '2x windscreen wiper replacement and fitting.', 25.50),
(12, 'Replacement Clutch', 'Replaced clutch on vehicle XXX XXX', 75.50);






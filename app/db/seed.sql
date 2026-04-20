INSERT INTO users (name, email) VALUES
('Alice Sharma', 'alice.sharma@gmail.com'),
('Rahul Verma', 'rahul.verma@gmail.com'),
('Priya Singh', 'priya.singh@gmail.com'),
('John Doe', 'john.doe@gmail.com'),
('Jane Doe', 'jane123doe@gmail.com');
INSERT INTO tickets (user_id, title, description, status) VALUES
(1, 'Cannot log in', 'User reports a login issue after password change.', 'open'),
(2, 'Feature request: dark mode', 'User requested dark theme support for the demo app.', 'in_progress'),
(3, 'Incorrect email displayed', 'Displayed email does not match profile settings.', 'closed');

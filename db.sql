create table transactions (
id INT AUTO_INCREMENT PRIMARY KEY,
date datetime NOT NULL,
`check` decimal(4) UNSIGNED UNIQUE,
descr varchar(250) NOT NULL,
amount decimal(10,2) NOT NULL
)
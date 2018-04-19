<?php
require_once __DIR__.'/vendor/autoload.php';
require_once 'config.inc.php';
use App\Database\DB as DB;

ini_set('display_errors','on');


DB::run("insert into branch_types values (NULL, 'REGIONAL')");
DB::run("insert into branch_types values (NULL, 'NATIONAL')");
DB::run("insert into branch_types values (NULL, 'branch_type 2')");
DB::run("insert into account_types values (NULL, 'CHECKINGS')");
DB::run("insert into account_types values (NULL, 'SAVINGS')");
DB::run("insert into transaction_types values (NULL, 'WITHDRAWAL')");
DB::run("insert into transaction_types values (NULL, 'DEPOSIT')");


// UNION QUERY
var_dump(DB::run("select *, 'BRANCH' as table_type from branch_types UNION select *, 'ACCOUNT' as table_types from account_types UNION select *, 'TRANSACTION' as table_type from transaction_types")->fetchAll());


// UPDATE
var_dump(DB::run("select * from branch_types")->fetchAll());
DB::run("update branch_types set type_description = 'UPDATED DESCRIPTION' where type_description = 'branch_type 2'");
var_dump(DB::run("select * from branch_types")->fetchAll());

// DELETE
var_dump(DB::run("select * from branch_types")->fetchAll());
DB::run("delete from branch_types where type_description = 'branch_type 2'");
var_dump(DB::run("select * from branch_types")->fetchAll());

echo "addresses\n\n";

DB::run("insert into addresses values (NULL, 'CUSTOMER', NULL, 'LONGWOOD', 'FL', '32779', 'USA')");
DB::run("insert into addresses values (NULL, 'CUSTOMER2', NULL, 'LONGWOOD', 'FL', '32779', 'USA')");
DB::run("insert into addresses values (NULL, 'CUSTOMER3', NULL, 'LONGWOOD', 'GA', '32779', 'USA')");
DB::run("insert into addresses values (NULL, 'BUSINESS', NULL, 'LONGWOOD', 'FL', '32779', 'USA')");
DB::run("insert into addresses values (NULL, 'BUSINESS2', NULL, 'LONGWOOD', 'FL', '32779', 'USA')");

echo "branches\n\n";

DB::run("insert into branches values (NULL, 4, 1)");
DB::run("insert into branches values (NULL, 5, 2)");

echo "customers\n\n";

DB::run("insert into customers values (NULL, 1, 1, 'M', '4074435855')");
DB::run("insert into customers values (NULL, 1, 2, 'M', '4074435855')");
DB::run("insert into customers values (NULL, 1, 3, 'M', '4074435855')");

echo "accounts\n\n";

DB::run("insert into accounts values (NULL, 1, 1, 1000.53)");
DB::run("insert into accounts values (NULL, 1, 2, 1000.53)");

echo "transactions\n\n";

DB::run("insert into transactions values (NULL, 1, 1, 50.0, CURRENT_TIMESTAMP )");
DB::run("insert into transactions values (NULL, 1, 2, 50.0, CURRENT_TIMESTAMP )");

// JOIN EXAMPLE
// Gets all whos bank is in the same state as their address is
var_dump(DB::run("select customers.gender, addresses.state from customers join branches on customers.branch_id = branches.id join addresses on branches.address_id = addresses.id where (select state from addresses where id = customers.address_id) = (select state from addresses where id = branches.address_id)")->fetchAll());


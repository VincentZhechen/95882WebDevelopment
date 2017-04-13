var mysql      = require('mysql');
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'root',
    password : '',
    port: '3306',
    database : 'project1'
});

connection.connect();

var sql = 'UPDATE goods SET tag = 1 WHERE id=2'

connection.query(sql, function (error, results, fields) {
    if (error) throw error;
});

connection.end();




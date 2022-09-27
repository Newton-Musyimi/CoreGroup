USE coregroup;
SELECT employees.username, assigned_technicians.employee_id FROM employees
JOIN assigned_technicians ON assigned_technicians.employee_id = employees.employee_id
WHERE assigned_technicians.wo_id = 1;
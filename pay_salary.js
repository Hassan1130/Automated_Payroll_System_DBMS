document.querySelector("#profile form").addEventListener("submit", function(event) {
    event.preventDefault(); 

    const employeeId = document.getElementById("employee-id").value;
    const employeeName = document.getElementById("employee-name").value;
    let salary = parseFloat(document.getElementById("Salary").value) || 0;
    let percentage = parseFloat(document.getElementById("Percentage").value) || 0;
    let loanEmi = parseFloat(document.getElementById("Emi").value) || 0;
    let leave = parseInt(document.getElementById("Leave").value) || 0;
    const bonusSelected = document.getElementById("bonus").value;
    let overtimeHours = parseFloat(document.getElementById("Overtime").value) || 0;

    console.log(percentage);
    const leaveDeductions = leave * 500; // Deduct 100 for each leave
    const overtimePay = overtimeHours * 300; // Pay 50 for each overtime hour
    const bonus = bonusSelected === "yes" ? (salary*percentage)/100 : 0; // Bonus is 500 if 'yes', otherwise 0

    // Calculate total salary
    const totalDeductions = loanEmi + leaveDeductions;
    const netSalary = (salary + overtimePay + bonus) - totalDeductions;

    // Update values in the second form
    document.getElementById("Id").value = employeeId;
    document.getElementById("tSalary").value = netSalary.toFixed(2);
    document.getElementById("Bonus").value = bonus.toFixed(2);
    document.getElementById("deductions").value = totalDeductions.toFixed(2);
    document.getElementById("loan").value = loanEmi.toFixed(2);
    document.getElementById("Leaves").value = leave;
    document.getElementById("time").value =overtimeHours;
});
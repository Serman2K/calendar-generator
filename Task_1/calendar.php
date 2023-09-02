<style>
    <?php include 'style.css'; ?>
</style>
<title>
    Kalendarz
</title>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = $_POST["month"];
    $year = $_POST["year"];
    $monthPL = array('Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
    
    $firstDayOfMonth = strtotime("$year-$month-01");
    $monthName = $monthPL[$month-1];
    
    // Tworzenie tabeli kalendarza
    $calendar = "<h2>$monthName $year</h2>";
    $calendar .= "<table>";
    $calendar .= "<tr><th>Pon</th><th>Wt</th><th>Śr</th><th>Czw</th><th>Pt</th><th>Sob</th><th class='red'>Niedz</th></tr>";
    
    // Wyświetlanie dni kalendarza
    $dayCounter = 1;
    $totalDays = date("t", $firstDayOfMonth);
    $firstDayOfWeek = date("N", $firstDayOfMonth);
    
    // Początek wpisywania dni
    $calendar .= "<tr>";
    for ($i = 1; $i < $firstDayOfWeek; $i++) {
        $calendar .= "<td></td>";
    }
    
    while ($dayCounter <= $totalDays) {
        for ($i = $firstDayOfWeek; $i <= 7; $i++) {
            if ($i == 7 && $dayCounter <= $totalDays) {
                $calendar .= "<td class='red'>$dayCounter</td>";
            } 
            else if ($dayCounter <= $totalDays) {
                $calendar .= "<td>$dayCounter</td>";
            }
            else {
                $calendar .= "<td></td>";
            }
            $dayCounter++;
        }
        $firstDayOfWeek = 1; // Resetuj pierwszy dzień tygodnia na poniedziałek
        if ($dayCounter <= $totalDays) {
            $calendar .= "</tr><tr>";
        }
    }
    
    $calendar .= "</tr>";
    $calendar .= "</table>";
    
    echo $calendar;
}
?>
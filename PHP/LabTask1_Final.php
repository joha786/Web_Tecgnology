<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
</head>
<body>

    <form method="POST">
        <input type="text" name="name" placeholder="Student Name: ">
        <input type="submit" value="Submit">
    </form>

    <?php


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sname = $_POST['name'];
        echo "Student Name: ", $sname ,"<br>";
        }

        function getAverage($marks){
            $totalMarks = 0;
            for($i=0; $i<count($marks); $i++){
                $totalMarks += $marks[$i];
            }
            echo "Total Marks: ", $totalMarks, "<br>";
            echo "Average Marks: ", (int)($totalMarks / count($marks)), "<br>";
        }        

        $marks = array(85, 90, 78, 92, 88);

        foreach ($marks as $index => $value){
            echo "Mark ",$index+1, ": ", $value, "<br>";
        }

        //for maximum mark
        $maxMark = $marks[0];
        for($i=1; $i<count($marks); $i++){
            if($marks[$i]>$maxMark){
                $maxMark = $marks[$i];
            }
        }
        
        //for minimum mark
        $minMark = $marks[0];;
        for($i=1; $i<count($marks); $i++){
            if($marks[$i]<$minMark){
                $minMark = $marks[$i];
            }
        }

        //pass and fail
        $passCount = 0;
        $failCount = 0;
        $totalCount = count($marks);
        for($i=0; $i<count($marks); $i++){
            if($marks[$i]>=50){
                $passCount++;
            }else{
                $failCount++;
            }
        }

        //total Mark
        $totalMarks = 0;
        for($i=0; $i<count($marks); $i++){
            $totalMarks += $marks[$i];
        }
        $averageMarks = $totalMarks / count($marks);
        getAverage($marks); 
        echo "Maximum Mark: " , $maxMark , "<br>";
        echo "Minimum Mark: " , $minMark , "<br>";
        echo "Pass Count: " , $passCount , "<br>";
        echo "Fail Count: " , $failCount , "<br>";

        $studentInfo = ["Name" =>"Joha", "ID" => "23-54073-3", "CGPA" => "3.98"];

        foreach($studentInfo as $key => $value){
            echo $key, ": ", $value, "<br>";
        }


        $name = $studentInfo["Name"];

        echo "Student's Name Length: ", strlen($name), "<br>";
        echo "Student's Name in Uppercase: ", strtoupper($name), "<br>";

    ?>
    
</body>
</html>
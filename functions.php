<?php

function db_query($query, $connection) {
    $result = mysqli_query($connection, $query);
    return $result;
}

/* TRANSACTIONS FOR ALL USERS */

// View the latest 10 books
function viewLatestBooks($connection) {
    $query = "SELECT B.Title, B.Barcode
               FROM   book as B
               LIMIT  10";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        foreach($rows as $row) { 
            $authors = viewBookAuthors($row['Barcode'], $connection);
            ?>
            <!-- HTML code for displaying book -->
            <tr>
                <td width="50%"><a href=""><?php echo $row['Title']; ?></a></td>
                <td width="50%"><?php echo $authors; ?></td>
            </tr>
    <?php
        } // end of for loop
    } // end of if
    else { mysqli_error($connection); }
}

// Get all authors for a sepcified book
function viewBookAuthors($bookID,$connection) {
    $query =  "SELECT   A.FName, A.LName
               FROM     author as A
               JOIN     author_books AS AB ON A.AuthorID = AB.AuthorID
               WHERE    AB.BookNo = $bookID";
    
    $authorList = "";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        foreach($rows as $row) {
            $authorList .= $row['FName'] . " " . $row['LName'];
        } // end of for loop
        
        return $authorList;
    } // end of if
    else { echo mysqli_error($connection); }
}

/* PATRON TRANSACTIONS */

function borrow($bookCode, $patronNo, $connection) {
    $query = "INSERT INTO   Borrows (BookID, PatronID, DueDate)
              VALUES        ($bookCode, $patronNo, DATE_ADD(CURDATE(), INTERVAL 14 DAY)";
    
    $result = db_query($query, $connection);
    
}

?>
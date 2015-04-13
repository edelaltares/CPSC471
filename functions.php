<?php

// Running a query
function db_query($query, $connection) {
    $result = mysqli_query($connection, $query);
    return $result;
}

// Quote escaping values to enter for insert
function db_quote($value,$connection) {
    if(!is_array($value)) {
        return "'" . mysqli_real_escape_string($connection, $value) . "'";
    }
}

/* TRANSACTIONS FOR ALL USERS */

// View all the books
function viewLatestBooks($connection) {
    $query =  "SELECT B.Title, B.Barcode
               FROM   book as B
               ORDER BY B.Title";
    
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
                <td width="50%"><a href="book.php?id=<?php echo $row['Barcode']; ?>"><?php echo $row['Title']; ?></a></td>
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
            $authorList .= $row['FName'] . " " . $row['LName'] . ", ";
        } // end of for loop
        $authorList = substr($authorList, 0, strlen($authorList)-2);
        return $authorList;
    } // end of if
    else { echo mysqli_error($connection); }
}

/* PATRON TRANSACTIONS */

// View all books taken out by a patron
function viewPatronsBooks($patronNo, $connection) {
    $query =   "SELECT  Title, Barcode, DueDate
                FROM    Borrows
                JOIN    Book ON BookNo = Barcode
                WHERE   PatronNo = $patronNo AND ReturnDate IS NULL";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        $patronNo = substr($patronNo, 1, strlen($patronNo) - 2);
        
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        if(!empty($rows)) { ?>
            
            <table width="100%">
                <!-- Table headers -->
                <tr>
                    <td width="33%"><h3>Title</h3></td>
                    <td width="33%"><h3>Author(s)</h3></td>
                    <td width="33%"><h3>Due Date</h3></td>
                </tr>
                <!-- Code for one book -->
            <?php
            foreach($rows as $row) { 
                $authors = viewBookAuthors($row['Barcode'], $connection);
                ?>
                <!-- HTML code for displaying book -->
                <tr>
                    <td width="33%">
                        <a href="book.php?id=<?php echo $row['Barcode']; ?>"><?php echo $row['Title']; ?></a> 
                        (<a href="return.php?book=<?php echo $row['Barcode']; ?>&patron=<?php echo $patronNo; ?>">Return</a> | 
                        <a href="renew.php?book=<?php echo $row['Barcode']; ?>&patron=<?php echo $patronNo; ?>">Renew</a>)
                    </td>
                    <td width="33%"><?php echo $authors; ?></td>
                    <td width="33%"><?php echo $row['DueDate']; ?></td>
                </tr>
        <?php
            } // end of for loop
            echo "</table>";
        } // end of if
        else { echo "Patron #$patronNo has no books taken out."; }
    } // end of if
    else { echo "Error!<br />" . mysqli_error($connection); }
}

// Borrowing a book
function borrow($bookCode, $patronNo, $connection) {
    $duedate = date('Y-m-d', strtotime(date('Y-m-d'). ' + 14 days'));
    
    $duedate = db_quote($duedate, $connection);
            
    $query = "INSERT INTO   Borrows
              VALUES        ($bookCode, $patronNo, null, $duedate)";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {  echo "Borrowed successfully!"; }
    else { echo mysqli_error($connection); }
}

// Returning a book
function returnBook($bookCode, $patronNo, $connection) {
    $query =   "UPDATE      Borrows
                SET         ReturnDate = CURDATE()
                WHERE       BookNo = $bookCode AND PatronNo = $patronNo";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) { echo "Returned successfully!"; }
    else { echo mysqli_error($connection); }
}

// Reserve a book
function reserveBook($bookCode, $patronNo, $connection) {
    $query =   "INSERT INTO Book_Holds
                VALUES($bookCode, $patronNo)";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) { echo "Reserved successfully!"; }
    else { echo mysqli_error($connection); }
}

// Receiving a reserved book
function unreserveBook($bookCode, $patronNo, $connection) {
    $query =   "DELETE FROM     Book_Holds
                WHERE           PatronNo = $patronNo
                AND             BookNo = $bookCode";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Reserved book received successfully";
        borrow($bookCode, $patronNo, $connection);
    }
    else { echo mysqli_error($connection); }
}

// view all holds for a patron
function viewAllHolds($patronNo, $connection) {
    $query =   "SELECT  *
                FROM    Book_Holds
                JOIN    Book ON BookNo = Barcode
                WHERE   PatronNo = $patronNo";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        if(!empty($rows)) { ?>
            <table width="100%">
                <!-- Table headers -->
                <tr>
                    <td width="33%"><h3>Title</h3></td>
                    <td width="33%"><h3>Author(s)</h3></td>
                    <td width="33%"><h3>Received</h3></td>
                </tr>
                <!-- Code for one book -->
            <?php
            foreach($rows as $row) { 
                $authors = viewBookAuthors($row['Barcode'], $connection);
                ?>
                <!-- HTML code for displaying book -->
                <tr>
                    <td width="33%"><a href=""><?php echo $row['Title']; ?></a></td>
                    <td width="33%"><?php echo $authors; ?></td>
                    <td width="33%"><a href="unreserve.php?id=<?php echo $row['Barcode']; ?>&patron=<?php echo $patronNo; ?>">Received</a></td>
                </tr>
            <?php
            }
            echo "</table>";
        }
    }
}

// Renew a book
function renew($book, $patron, $connection) {
    $query =   "UPDATE  Book, Borrows
                SET     DueDate = DATE_ADD(DueDate, INTERVAL 14 DAY)
                WHERE   Book.Barcode = $book
                AND     Borrows.PatronNo = $patron
                AND     Borrows.BookNo = Book.Barcode
                AND     NOT EXISTS 
                        (
                        SELECT  *
                        FROM    Book_Holds JOIN Book
                        ON      Book_Holds.BookNo = Book.Barcode
                        )";
        
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Renewed book successfully";
    }
    else { echo mysqli_error($connection); }
}

// View a book
function viewBook($bookCode, $connection) {
    $query =   "SELECT  *
                FROM    Book
                JOIN    Branch ON BranchNum = BranchNo
                WHERE   Barcode = $bookCode";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        foreach($rows as $row) { ?>
            <h2><?php echo $row['Title']; ?></h2>

            <h3><?php echo viewBookAuthors($bookCode, $connection); ?></h3>

            <p>
                <a href="reserve.php?id=<?php echo $bookCode; ?>">Put on hold</a><br />
                ISBN: <?php echo $row['ISBN']; ?><br />
                Call Number: <?php echo $row['CallNo']; ?><br />
                Branch Location: <?php echo $row['BranchName']; ?><br />
            </p>

            <p><?php echo $row['Summary']; ?></p>
    <?php
        }
    }
    else { echo mysqli_error($connection); }
} 

// Pay off late fees
function payLateFees($patron, $conenction) {
    
}

/* EVENTS */

// Add an event
function addEvent($name,$date,$description,$branchno, $staff,$connection) {
    /* INSERT INTO EVENT TABLE */
    
    $query =   "INSERT INTO     Lib_event
                VALUES          ($name,$date,$description,$branchno)";
    
    // Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Inserted event successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }
    
    /* INSERT INTO EVENT_STAFF TABLE */
    
    $query =   "INSERT INTO     Event_Staff
                VALUES          ($name,$staff)";
    
    // Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Inserted event successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }
}

// View all events
function viewEvents($connection) {
    $query =   "SELECT  *
                FROM    Lib_event
                JOIN    Branch ON BranchNo = BranchNum
                ORDER BY EDate DESC";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        foreach($rows as $row) { ?>
            <!-- Code for one event -->
            <h3><?php echo $row['EventName']; ?></h3>
            <p>
                <a href=""><?php echo "Register for event"; ?></a><br />
                <strong>Date:</strong> <?php echo $row['EDate']; ?><br />
                <strong>Location:</strong> <?php echo $row['BranchName']; ?>
            </p>  
            <p><?php echo $row['Description']; ?></p>   
            <!-- Code for one event -->
<?php
        } // end foreach loop
    } // end of if
    else { echo mysqli_error($connection); }
}


// Add a book
function addBook($ScannedBarcode,$InputtedISBN,$InputtedCallNo,$InputtedTitle,$InputtedBranchInfo,$InputtedSummaryCanBeBlank,$pubName,$AuthorID,$connection) {
	//INSERT INTO BOOK TABLE
	$query =   "INSERT INTO        Book(Barcode,ISBN, CallNo, Title, Summary, BranchNumber)
                VALUES        ($ScannedBarcode,$InputtedISBN ,$InputtedCallNo, $InputtedTitle, 
                    		$InputtedSummaryCanBeBlank, 
                    		$InputtedBranchInfo)";
	
	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Inserted event successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }
	//INSERT INTO Publisher_Books TABLE
	$query = "INSERT
       		  INTO        Publisher_Books
       		  VALUES    ($pubName, $ScannedBarcode)";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Inserted event successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }

	//INSERT INTO Author_Books TABLE
	$query = "INSERT
       		  INTO        Author_Books
       		  VALUES    ($AuthorID, $ScannedBarcode)";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Inserted event successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }

	
}

function addPatron($CardNo,$FirstName,$LastName,$Email,$Address,$City,$PostalCode,$CardExpiry,$AccountType,$Password, $connection) {
	//INSERT into Patron table
	$query = "INSERT INTO 		Patron
			  VALUES			($CardNo,$FirstName,$LastName,$Email,$Address,$City,$PostalCode,$CardExpiry,$AccountType,$Password)";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Inserted event successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }
}

function hireStaff($givenSIN, $givenFirstName, $givenLastName, $givenEmail,$givenAddress, $givenCity, $givenPostalCode,$decidedWage,$decidedPosition, $theirSupervisorSSN, $givenBranchNo, $password,$connection) {
	//INSERT into Staff table
	$query = 	"INSERT INTO        Staff
        		VALUES        	($givenSIN, $givenFirstName, $givenLastName, $givenEmail, 
                   			 	$givenAddress, $givenCity, $givenPostalCode, 
            					$decidedWage, 
                    			$decidedPosition, $theirSupervisorSSN, $givenBranchNo, $password)";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Inserted event successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }

}

function addBranch($BranchNo,$BranchName,$PhoneNo,$Address,$ManagerSIN,$connection) {
	//INSERT into Branch table
	$query = "INSERT INTO 	Branch
			  VALUES		($BranchNo,$BranchName,$PhoneNo,$Address,$ManagerSIN)";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Inserted event successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }
}

function addAuthor($AuthorID,$FirstName,$LastName,$connection) {
	//INSERT into Author table
	$query = "INSERT INTO 	Author
			  VALUES		($AuthorID,$FirstName,$LastName)";  
	
	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Inserted event successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }
}

function addPublisher($name, $connection) {
	//INSERT into Publisher table
	$query = "INSERT INTO 	Publisher
			  VALUES		($name)";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Inserted event successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }
}

?>

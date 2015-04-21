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

// View all branches
function viewBranches($connection) {
    $query =   "SELECT  *
                FROM    branch";
    
    $result = db_query($query, $connection);
    
    if($result != false) {
        $count = mysqli_num_rows($result);
        
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        } ?>

        <table width="100%">
        <?php
        $i = 0;
        while($i < $count) {
            if($i % 2 == 0) { ?>
                <tr>
                    <td width="50%" style="padding-bottom:15px;">
                        <?php 
                        echo "<strong>" . $rows[$i]['BranchName'] . "</strong><br />";
                        echo $rows[$i]['Address'] . "<br />";
                        echo $rows[$i]['City'] . " " . $rows[$i]['PCode'] . "<br />";
                        echo $rows[$i]['PhoneNo'];
                        ?>
                    </td>
            <?php
            }
            else { ?>
                    <td width="50%" style="padding-bottom:15px;">
                        <?php
                        echo "<strong>" . $rows[$i]['BranchName'] . "</strong><br />";
                        echo $rows[$i]['Address'] . "<br />";
                        echo $rows[$i]['City'] . " " . $rows[$i]['PCode'] . "<br />";
                        echo $rows[$i]['PhoneNo'];
                        ?>
                    </td>
                </tr>
            <?php
            }
            $i++;
        } ?>
        </table>
    <?php
    }
    else { echo mysqli_error($connection); }
}

// Logging in
function login($user, $pw, $type, $connection) {
    if($type == "Patron") { $key = "CardNo"; }
    else { $key = "SIN"; }
    
    $query =   "SELECT  *
                FROM    $type
                WHERE   $key = $user
                AND     Password = $pw";
    
    $result = db_query($query, $connection);
    
    if($result != false) {
        $count = mysqli_num_rows($result);

        if($count == 1) {
            if($type == "Patron") { $_SESSION['patron'] = $user; }
            else { $_SESSION['staff'] = $user; }
            return true;
        }
        else { echo "<h2>$type Panel</h2>\nInvalid login."; }
    }
    else { echo "<h2>$type Panel</h2>\nInvalid login." . mysqli_error($connection); }
    
    return false;
}

// Return name from user key
function viewUserName($user, $type, $connection) {
    if($type == "Patron") { $key = "CardNo"; }
    else { $key = "SIN"; }
    
    $query =   "SELECT  FName, MName, LName
                FROM    $type
                WHERE   $key = $user";
    
    $result = db_query($query, $connection);
    
    $count = mysqli_num_rows($result);

    if($result != false && $count == 1) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        foreach($rows as $row) {
            echo $row['FName'] . " " . $row['MName'] . " " . $row['LName'];
        }
    }
    else { echo "$type #$user" . mysqli_error($connection); }
}

// Check if manager
function checkManager($user, $connection) {
    $query =   "SELECT  *
                FROM    Staff
                WHERE   EXISTS
                       (SELECT  *
                        FROM    Branch
                        WHERE   ManagerSIN = $user)";
    
    $result = db_query($query, $connection);

    if($result != false) { return 1; }
    else { return 2; }
}

// View all the books
function viewLatestBooks($connection) {
    $query =  "SELECT DISTINCT  B.Title, B.Barcode
               FROM   book as B
               ORDER BY B.Title";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        if(!empty($rows)) {
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
        }
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
        
        if(!empty($rows)) {
            foreach($rows as $row) {
                $authorList .= $row['FName'] . " " . $row['LName'] . ", ";
            } // end of for loop
            $authorList = substr($authorList, 0, strlen($authorList)-2);
            return $authorList;
        }
        else { return "No authors listed."; }
    } // end of if
    else { echo mysqli_error($connection); }
}

/* PATRON TRANSACTIONS */

// Patron info
function patronInfo($username, $connection) {
    $query =   "SELECT  *
                FROM    patron
                WHERE   CardNo = $username";
    
    $result = db_query($query, $connection);
    
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        foreach($rows as $row) {
            echo "<strong>Address</strong><br />\n";
            echo $row['Address'] . "<br />\n" . $row['City'] . " " . $row['PCode'] . "<br />\n";
            
            echo "<strong>Email:</strong> " . $row['Email'] . "<br />";
            
            echo "<strong>Phone Number:</strong> " . showPhoneNo($username, $connection) . "<br />";
            
            echo "<strong>Account Type:</strong> " . $row['Accnt_Type'] . "<br />\n";
            
            echo "<strong>Card Expiry Date:</strong> " . $row['CrdExp'] . "<br />";
        
            echo "<strong>Fees:</strong> " . showTotalFees($username, $connection);
        }
    }
}

//search for book
function searchBook($keywordsearch, $connection) {
    $query =     "SELECT    *
                  FROM      Book
                  WHERE     Title like '%$keywordsearch%'";

    $result = db_query($query, $connection);

    // Check if result is valid
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        if(!empty($rows)) { ?>
            
            <table width="100%">
                <tr>
                    <td width="50%"><h3>Title</h3></td>
                    <td width="50%"><h3>Author(s)</h3></td>
                </tr>
            
        <?php
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
            echo "</table>";
        } // end of if
        else { echo "No results found."; }
    } // end of if
    else { mysqli_error($connection); }
}

function viewRated($patronNo, $connection) {
    $query =   "SELECT  *
                FROM    Book_Ratings
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
                    <td width="33%"><h3>Rating</h3></td>
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
                    <td width="33%"><?php echo $row['rating']; ?></td>
                </tr>
            <?php
            }
            echo "</table>";
        }
        else { echo "<br />No books rated."; }
    }
}

// View all books taken out by a patron
function viewPatronsBooks($patronNo, $connection) {
    $query =   "SELECT  *
                FROM    Borrows
                JOIN    Book ON BookNo = Barcode
                WHERE   PatronNo = $patronNo";
    
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
                    <td width="20%"><h3>Title</h3></td>
                    <td width="20%"><h3>Author(s)</h3></td>
                    <td width="20%"><h3>Due Date</h3></td>
                    <td width="20%"><h3>Return Date</h3></td>
                    <td width="20%"><h3>Rate</h3></td>
                </tr>
                <!-- Code for one book -->
            <?php
            foreach($rows as $row) { 
                $authors = viewBookAuthors($row['Barcode'], $connection);
                ?>
                <!-- HTML code for displaying book -->
                <tr>
                    <td width="20%">
                        <a href="book.php?id=<?php echo $row['Barcode']; ?>"><?php echo $row['Title']; ?></a> 
                        (<a href="return.php?book=<?php echo $row['Barcode']; ?>&patron=<?php echo $patronNo; ?>">Return</a> | 
                        <a href="renew.php?book=<?php echo $row['Barcode']; ?>&patron=<?php echo $patronNo; ?>">Renew</a>)
                    </td>
                    <td width="20%"><?php echo $authors; ?></td>
                    <td width="20%">
                        <?php
                        if($row['DueDate'] != "0000-00-00") {
                            echo $row['DueDate'];
                        }
                        else { echo "Returned"; }
                        ?></td>
                    <td width="20%">
                        <?php
                        if($row['ReturnDate'] != null) {
                            echo $row['ReturnDate'];
                        }
                        else { echo "Checked out."; }
                        ?>
                    </td>
                    <td width="20%">
                        <form action="view-patrons-books.php?book=<?php echo $row['Barcode']; ?>&patron=<?php echo $patronNo; ?>" method="POST">
                            <select name="rating">
$                               <option value="0" <?php if(bookRating($row['Barcode'], $patronNo, $connection) == "0") { echo "selected"; } ?>>0</option>
                                <option value="1" <?php if(bookRating($row['Barcode'], $patronNo, $connection) == "1") { echo "selected"; } ?>>1</option>
                                <option value="2" <?php if(bookRating($row['Barcode'], $patronNo, $connection) == "2") { echo "selected"; } ?>>2</option>
                                <option value="3" <?php if(bookRating($row['Barcode'], $patronNo, $connection) == "3") { echo "selected"; } ?>>3</option>
                                <option value="4" <?php if(bookRating($row['Barcode'], $patronNo, $connection) == "4") { echo "selected"; } ?>>4</option>
                                <option value="5" <?php if(bookRating($row['Barcode'], $patronNo, $connection) == "5") { echo "selected"; } ?>>5</option>
                            </select>
                            <input type="submit" value="Rate" name="rate" />
                        </form>
                    </td>
                </tr>
        <?php
            } // end of for loop
            echo "</table>";
        } // end of if
        else { echo "Patron #$patronNo has no books taken out."; }
    } // end of if
    else { echo "Error!<br />" . mysqli_error($connection); }
}

// Rate a book
function rateBook($book,$rating, $patron, $connection) {
    if(bookRating($book, $patron, $connection) == false) {
        $query =   "INSERT INTO book_ratings
                    VALUES  ($book,$patron,$rating)";

        $result = db_query($query, $connection);

        if($result != false) { echo "Book rated successfully!"; }
        else { echo "Error rating book!<br />" .  mysqli_error($connection); }
    }
    else {
        $query =   "DELETE FROM book_ratings
                    WHERE       BookNo = $book
                    AND         PatronNo = $patron";
        
        $result = db_query($query, $connection);
        
        if($result != false) {
            rateBook($book, $rating, $patron, $connection);
        }
        else { echo "Error changing rating!<br />" . mysqli_errno($connection); }
    }
}
// Book rating
function bookRating($barcode, $patron, $connection) {
    $query =   "SELECT  *
                FROM    book_ratings
                WHERE   BookNo = $barcode
                AND     PatronNo = $patron";
    
    $result = db_query($query, $connection);
    
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        if(!empty($rows)) {
            foreach($rows as $row) {
                return $row['rating'];
            }
        }
    }
    else { return false; }
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
        else { echo "<br />No books on hold."; }
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

            <table width="100%">
                <tr>
                    <td><img src="http://placehold.it/200x300&text=No+Cover" /></td>
                    <td>
                        <h2><?php echo $row['Title']; ?></h2>
                        <h3>By <?php echo viewBookAuthors($bookCode, $connection); ?></h3>
                        <a href="reserve.php?id=<?php echo $bookCode; ?>">Put on hold</a><br />
                        ISBN: <?php echo $row['ISBN']; ?><br />
                        Publisher: France<br />
                        Call Number: <?php echo $row['CallNo']; ?><br />
                        Branch Location: <?php echo $row['BranchName']; ?><br />
                        Genre: Romance<br />
                        Rating Average: 3.33
                        <p><?php echo $row['Summary']; ?></p>
                    </td>
                </tr>
            </table>
    <?php
        }
    }
    else { echo mysqli_error($connection); }
} 

// Show all  fees
function showTotalFees($patron, $connection) {
    $query =   "SELECT  SUM(datediff(CURDATE(), DueDate) * 0.25)
                FROM    Borrows
                WHERE   PatronNo = $patron
                AND     ReturnDate IS NULL";
    
    $result = db_query($query, $connection);
    
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    
    foreach($rows as $row) {
        $fees = $row['SUM(datediff(CURDATE(), DueDate) * 0.25)'];
        if($fees > 0) { return $fees; }
        else { return 0; } 
    }
}

// Show fees for each book
function showSeparateFees($patron, $connection) {
    $query =   "SELECT  Title, Barcode, DueDate, SUM(datediff(CURDATE(), DueDate) * 0.25)
                FROM    Borrows
                JOIN    Book ON BookNo = Barcode
                WHERE   PatronNo = $patron
                AND     ReturnDate IS NULL
                GROUP BY BookNo";
    
    $result = db_query($query, $connection);
    
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if(!empty($rows)) { ?>
        <table width="100%">
            <tr>
                <td width="25%"><h3>Title</h3></td>
                <td width="25%"><h3>Author</h3></td>
                <td width="25%"><h3>Due Date</h3></td>
                <td width="25%"><h3>Fees</h3></td>
            </tr>
        <?php
        foreach($rows as $row) {
            $fees = $row['SUM(datediff(CURDATE(), DueDate) * 0.25)'];
            if($fees > 0) { ?>
            <tr>
                <td width="25%"><?php echo $row['Title']; ?></td>
                <td width="25%"><?php $authors = viewBookAuthors($row['Barcode'], $connection); echo $authors; ?></td>
                <td width="25%"><?php echo $row['DueDate']; ?></td>
                <td width="25%"><?php echo $fees; ?></td>
            </tr>
            <?php 
            }
            else {
                echo $row ['Title'] . " " . 0;
                
            } 
        }
        echo "</table>";
    }
}

function showPhoneNo($patron, $connection) {
    $query =   "SELECT  *
                FROM    patron_phoneno
                WHERE   PatronNo = $patron";
    
    $result = db_query($query, $connection);
    
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        if(!empty($rows)) {
            $string = "";

            foreach($rows as $row) {
                $string .= $row['PhoneNo'] . ", ";
            }

            $string = substr($string, 0, strlen($string) - 2);
            return $string;
        }
        else { return "No phone numbers."; }
    }
}

function payFees($patron, $amount, $type, $connection) {
    $query =   "INSERT INTO Payments
                SET         Amount = $amount
                WHERE       PatronNo = $patron
                AND         Date = CURDATE()
                AND         Type = $type";
        
    // Record payment
    $result = db_query($query, $connection);
    
    if($result != false) {
        if(showFees($patron, $connection) > 0 && $type == "Late Fees") {
            $query =   "UPDATE  Borrows";
                    
        }
    }
    else { echo "An error occurred." . mysqli_error($connection); }
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
        echo "Insert successfull!";
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
        echo "Insert successfull!";
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
                <a href="register-event.php?event=<?php echo $row['EventName']; ?>"><?php echo "Register for event"; ?></a><br />
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

// Register for an event
function registerEvent($event, $patron, $connection) {
    $query =   "INSERT INTO event_attendance(EventName, PatronNo)
                VALUES      ($event, $patron)";
    
    $result = db_query($query, $connection);
    
    if($result != false) {
        echo "Registered for event successfulyl!";
    }
    else { echo "Error registering for event!<br />" . mysqli_error($connection); }
}

// View events registered
function viewEventsRegistered($patron, $connection) {
    $query =   "SELECT  *
                FROM    event_attendance
                JOIN    lib_event   ON lib_event.EventName = event_attendance.EventName
                JOIN    branch      ON BranchNum = BranchNo
                WHERE   PatronNo = $patron";
    
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        if(!empty($rows)) { ?>
            <?php
            foreach($rows as $row) { 
                ?>
                <h3><?php echo $row['EventName']; ?></h3>
                <p>
                    <strong>Date:</strong> <?php echo $row['EDate']; ?><br />
                    <strong>Location:</strong> <?php echo $row['BranchName']; ?>
                </p>  
                <p><?php echo $row['Description']; ?></p>   
            <?php
            }
        }
        else { echo "<br />Not registered in any events."; }
    }
}

//Remove a book
function removeBook($bookNo,$connection) {
	//Delete from Book table
	$query = 		"DELETE FROM     Book
       				 WHERE         Barcode = $bookNo";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Remove successfull!";
    }
    else {
        echo "Remove failed.";
        echo mysqli_error($connection);
    }

	//Delete if Audiobook
	$query = 		"DELETE FROM     Audiobook
       				 WHERE         
						EXISTS(SELECT  *
								FROM	Audiobook
								WHERE 	AudioBookNumber = $bookNo)
					AND		AudioBookNumber = $bookNo";

	// Run query
    $result = db_query($query, $connection);
    

	//Delete if Journal
	$query = 		"DELETE FROM     Journal
       				 WHERE         
						EXISTS(SELECT  *
								FROM	Journal
								WHERE 	JournalNumber = $bookNo)
					AND				JournalNumber = $bookNo";

	// Run query
    $result = db_query($query, $connection);
    

	
}

// Add a book
function addBook($type, $ISBN, $CallNo, $Title, $BranchNo, $Summary, $Publisher, $FName, $MName, $LName, $Genre, $connection) {
    $query2 = "SELECT  *
                    FROM    Book
                    WHERE   ISBN = $ISBN AND CallNo = $CallNo AND Title = $Title AND Summary = $Summary AND BranchNum = $BranchNo";
    
    $query =   "INSERT INTO     Book
                VALUES  ('null',$ISBN, $CallNo, $Title, $Summary, $BranchNo)";
    
    // Run query
    $result = db_query($query, $connection);
    $result2 = db_query($query2, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Insert book successfull!<br />";
        
        if($result2 != false) {
            while($row = mysqli_fetch_assoc($result2)) {
                $rows[] = $row;
            }
            foreach($rows as $row) {
                $ScannedBarcode = db_quote($row['Barcode'], $connection);
            }
        }
        else { $ScannedBarcode = db_quote(mysqli_insert_id($connection),$connection); }
        
        //INSERT INTO genre TABLE
        addGenre($Genre, $ScannedBarcode, $connection);
        
        //INSERT INTO Publisher TABLE
        addPublisher($Publisher, $ScannedBarcode, $connection);
        
        //INSERT INTO Author TABLE
        if($MName == "''") {
            $MName = "null";
            $MName = db_quote($MName, $connection);
        }
        addAuthor($FName, $MName, $LName, $ScannedBarcode, $connection);
    }
    else { echo "Insert book failed.<br />" . mysqli_error($connection); }
}

// Add genre
function addGenre($Genre, $Book, $connection) {
    $query =   "INSERT INTO genre
                VALUES  ($Genre, $Book)";
    
    $result = db_query($query, $connection);
    
    if($result != false) { echo "Insert genre successfull!<br />"; }
    else { echo "Insert genre failed.<br />" . mysqli_errno($connection); }
}

function removePatron($CardNo,$connection) {

	//Delete from Patron table
	$query = 		"DELETE FROM     Patron
       				 WHERE         CardNo = $CardNo";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Remove successfull!";
    }
    else {
        echo "Remove failed.";
        echo mysqli_error($connection);
    }
}

function addPatron($PhoneNo,$CardNo,$FirstName,$MiddleName,$LastName,$Email,$Address,$City,$PostalCode,$CardExpiry,$AccountType,$Password, $connection) {
    //INSERT into Patron table
    $query =   "INSERT INTO Patron
                VALUES      ($CardNo,$FirstName,$MiddleName,$LastName,$Email,$Address,$City,$PostalCode,$CardExpiry,$AccountType,$Password)";

    // Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Insert successfull!";
        
        $PatronNo = mysqli_insert_id($connection);
                
        $query =   "INSERT INTO patron_phoneno
                    VALUES      ($PhoneNo,$PatronNo)";
        $result = db_query($query, $connection);
        if($result != false) { echo "Phone number inserted!"; }
        else { echo mysqli_error($connection); }
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }
}

function removeStaff($SIN,$connection) {
	//Delete from Staff table
	$query =    "DELETE FROM     Staff
                    WHERE           SIN = $SIN";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Delete successfull!";
    }
    else {
        echo "Delete failed.";
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
        echo "Insert successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }

}

function removeBranch($bno,$connection) {

	//Delete from Branch table
	$query = 		"DELETE FROM     Branch
       				 WHERE         BranchNo = $bno";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Delete successfull!";
    }
    else {
        echo "Delete failed.";
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
        echo "Insert successfull!";
    }
    else {
        echo "Insert failed.";
        echo mysqli_error($connection);
    }
}

function removeAuthor($id,$connection) {

	//Delete from Author table
	$query = 		"DELETE FROM     Author
       				 WHERE         AuthorID = $id";

	// Run query
    $result = db_query($query, $connection);
    
    // Check if result is valid
    if($result != false) {
        echo "Delete successfull!";
    }
    else {
        echo "Delete failed.";
        echo mysqli_error($connection);
    }
}

function addAuthor($FirstName,$MiddleName,$LastName,$book,$connection) {
    // Check if author is already in database
    $query  =  "SELECT  AuthorID
                FROM    author
                WHERE   FName = $FirstName AND MName = $MiddleName AND LName = $LastName";
    
    $result = db_query($query, $connection);
    
    if($result != false) {
        $query =   "INSERT INTO author
                    VALUES      ('null',$FirstName,$MiddleName,$LastName)";
        // Run query
        $result = db_query($query, $connection);

        // Check if result is valid
        if($result != false) {
            echo "Insert author successfull!<br />";
            $name = db_quote(mysqli_insert_id($connection),$connection);
            // Insert relationship
            if(isset($book)) {
                $query =   "INSERT INTO author_books(AuthorID, BookNo)
                            VALUES      ($name, $book)";
                // Run query
                $result = db_query($query, $connection);
                // Check if result is valid
                if($result != false) { echo "Insert author relationship successful!<br />"; }
                else { echo "Insert author relationship failed.<br />" . mysqli_errno($connection); }
            }
        }
        else {echo "Insert author failed." . mysqli_error($connection); }
    }
    else {
        echo "Author already exists!<br />";
        
            print_r($result);
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        foreach($rows as $row) {
            // Insert relationship
            $name = db_quote($row['AuthorID'],$connection);
            if(isset($book)) {
                $query =   "INSERT INTO author_books(AuthorID, BookNo)
                            VALUES      ($name, $book)";
                // Run query
                $result = db_query($query, $connection);
                // Check if result is valid
                if($result != false) { echo "Insert author relationship successful!<br />"; }
                else { echo "Insert author relationship failed.<br />" . mysqli_errno($connection); }
            }
        }
    }
}

function addPublisher($name, $book, $connection) {
    // Check if publisher is already in database
    $query  =  "SELECT  *
                FROM    publisher
                WHERE   PublisherName = $name";
    
    $result = db_query($query, $connection);
    
    if($result == false) {
        $query =   "INSERT INTO Publisher
                    VALUES      ($name)";
        // Run query
        $result = db_query($query, $connection);

        // Check if result is valid
        if($result != false) {
            echo "Insert publisher successfull!<br />";
            
            // Insert relationship
            if(isset($book)) {
                $query =   "INSERT INTO publisher_books(PublisherName, BookNo)
                            VALUES      ($name, $book)";
                // Run query
                $result = db_query($query, $connection);
                // Check if result is valid
                if($result != false) { echo "Insert publisher relationship successful!<br />"; }
                else { echo "Insert publisher relationship failed.<br />" . mysqli_errno($connection); }
            }
        }
        else {echo "Insert publisher failed." . mysqli_error($connection); }
    }
    else {
        echo "Publisher already exists!<br />";
        
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
        foreach($rows as $row) {
            // Insert relationship
            $name = db_quote($row['PublisherName'],$connection);
            if(isset($book)) {
                $query =   "INSERT INTO publisher_books(PublisherName, BookNo)
                            VALUES      ($name, $book)";
                // Run query
                $result = db_query($query, $connection);
                // Check if result is valid
                if($result != false) { echo "Insert publisher relationship successful!<br />"; }
                else { echo "Insert publisher relationship failed.<br />" . mysqli_errno($connection); }
            }
        }
    }
}

?>

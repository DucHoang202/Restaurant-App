<?php
require_once("db.php");

function get_friend( $id) {
    global $conn;
    $sql = "SELECT profile_name FROM friends WHERE friend_id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $rows = mysqli_fetch_assoc($result);
        return $rows["profile_name"];
    } else {
        return "Unknown";
    }
}

function count_mutual_friends( $user,  $target) {
    global $conn;
    $sql = "SELECT COUNT(*) AS mutual_count FROM myfriends AS mf1
            JOIN myfriends AS mf2 ON mf1.friend_id2 = mf2.friend_id2
            WHERE mf1.friend_id1 = '$user' AND mf2.friend_id1 = '$target'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['mutual_count'];
}

function dar_talk($darwin) {
    echo "<style>
            @media (min-width: 1800px) {
                #darwinMessage, #darwinMessage1 {
                    position: relative;
                    display: block; 
                }
            }
            @media (max-width: 1800px) {
                #darwinMessage, #darwinMessage1 {
                    display: none; 
                }
            }
          </style>";
    echo "<img id='darwinMessage' src='/cos30020/s103809938/assign2//images/chit.jpg' style='max-width: 40%; max-height: 40%; position: relative; bottom:583px; left: -444px;'>";
    echo "<h3 id='darwinMessage1' style='position: relative; bottom:928px; left: -364px;'>$darwin</h3>";
    echo "<script>
            setTimeout(function() {
                document.getElementById('darwinMessage').style.display = 'none';
                document.getElementById('darwinMessage1').style.display = 'none';
            }, 2000);
          </script>";
}

function gum_talk($gumball) {
    echo "<style>
            @media (min-width: 1800px) {
                #gumballMessage, #gumballMessage1 {
                    position: relative;
                    display: block; 
                }
            }
            @media (max-width: 1800px) {
                #gumballMessage, #gumballMessage1 {
                    display: none; 
                }
            }
          </style>";
    echo "<img id='gumballMessage' src='/cos30020/s103809938/assign2//images/chit.jpg' style='transform: scaleX(-1); max-width: 40%; max-height: 40%; position: relative; bottom:1083px; left: 756px;'>";
    echo "<h3 id='gumballMessage1' style='position: relative; bottom: 1428px; left: 843px;'>$gumball</h3>";
    echo "<script>
            setTimeout(function() {
                document.getElementById('gumballMessage').style.display = 'none';
                document.getElementById('gumballMessage1').style.display = 'none';
            }, 2000);
          </script>";
}
function talking() {
    echo "<style>
            @media (min-width: 1800px) {
                #anchor {
                    position: relative;
                    display: block; 
                }
            }
            @media (max-width: 1800px) {
                #anchor {
                    display: none; 
                }
            }
          </style>";
    echo "<img class='anchor' id='anchor' src='/cos30020/s103809938/assign2//images/gg.png' alt='Picture'/>";

    echo "<script>
            const picture = document.getElementById('anchor');
            let position = 3;
            let count = 0;
            function animate() {
                picture.style.transform = 'translateY(' + position + 'px)';
                position = position === 3 ? -3 : 3;
                count++;
                if (count < 10) {
                    setTimeout(animate, 100);
                }
            }
            animate();
          </script>";
}

function Unfriend( $id) {
    global $conn;
    global $user;
    $delete = "DELETE FROM myfriends WHERE friend_id1 = '$user' AND friend_id2 = '$id'";
    $have = mysqli_query($conn, $delete);
    if (!$have) {
        echo "<div class='alert alert-danger'>Cannot delete friend " . $id . "</div>";
    }
}

function Addfriend( $id) {
    global $conn;
    global $user;
    $add = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES ('$user', '$id')";
    $have = mysqli_query($conn, $add);
    if (!$have) {
        echo "<div class='alert alert-danger'>Cannot add friend " . $id . "</div>";
    }
}
?>
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo addNewMember(
        $_POST['agentName'],
        $_POST['teamName'],
        $_POST['agentEmail'],
        $_POST['agentPhone'],
        $_POST['state'],
        $_POST['brokerage'],
        $_POST['lastMonthSales'],
        $_POST['zillowProfile'],
        $_POST['zillowReviews'],
        $_POST['website'],
        $_POST['blog'],
        $_POST['facebook'],
        $_POST['instagram'],
        $_POST['linkedIn'],
        $_POST['pinterest'],
        $_POST['twitter'],
        $_POST['youtube'],
        $_POST['notes']
    );

    // echo addNewMember(
    //     'Agent Name',
    //     'Team Name',
    //     'State',
    //     'Broker',
    //     'Month Sales',
    //     'Agent Phone',
    //     'Agent Email',
    //     'Zillow Profile',
    //     'Zillow Reviews',
    //     'Webiste',
    //     'Blog',
    //     'Facebook',
    //     'Instagram',
    //     'Linked In',
    //     'Pinterest',
    //     'Twitter',
    //     'Youtube',
    //     'Notes'
    // );
}

function addNewMember(
    $name,
    $teamName,
    $state,
    $brokerage,
    $lastMonthSales,
    $phone,
    $email,
    $profile,
    $zillowReviews,
    $website,
    $blog,
    $facebook,
    $instagram,
    $linkedIn,
    $pinterest,
    $twitter,
    $youtube,
    $notes
) {

    $data = readCSV();

    $newId = count($data) > 0 ? end($data)[0] + 1 : 1;

    $newEntry = [
        $newId,
        htmlspecialchars($name),
        htmlspecialchars($teamName),
        htmlspecialchars($state),
        htmlspecialchars($brokerage),
        htmlspecialchars($lastMonthSales),
        htmlspecialchars($phone),
        htmlspecialchars($email),
        htmlspecialchars($profile),
        htmlspecialchars($zillowReviews),
        htmlspecialchars($website),
        htmlspecialchars($blog),
        htmlspecialchars($facebook),
        htmlspecialchars($instagram),
        htmlspecialchars($linkedIn),
        htmlspecialchars($pinterest),
        htmlspecialchars($twitter),
        htmlspecialchars($youtube),
        htmlspecialchars($notes),
        'Active'
    ];
    $data[] = $newEntry;

    writeCSV($data);

    return json_encode(['status' => 'success', 'message' => 'Team member added successfully']);
}

?>
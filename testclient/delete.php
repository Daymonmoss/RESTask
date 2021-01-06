<?php
if(isset($_POST['users_ids'])) {
    foreach($_POST['users_ids'] as $id) {
        $ids[] = (int) $id;

        $jsonids = json_encode($ids,true);
        $filename = 'incoming.txt';
        file_put_contents($filename, $jsonids);

    }
    header( "Refresh:1; url=http://testclient.ok/", true, 303);
}
?>
<!DOCTYPE html>
<html>
<body>
<header>
    <h1>Пользователи с ID <?= $jsonids ?> удалены!</h1>
</header>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // const usersids = new Array ([id]);
        fetch('http://testtask.ok/processingdelete.php', {
            method: 'POST',
            mode: 'no-cors',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(<?php echo $jsonids ?>)
        })
            .catch(error => console.log(error))
    })
</script>


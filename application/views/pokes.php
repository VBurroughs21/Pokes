<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Pokes</title>
    </head>
    <body>
        <div>
            <div>
                <h3> Welcome <?= $name ?>!</h3>
                <a href="/sessions/logout">Logout</a>
                <p><?= $this->session->userdata('count_pokes') ?> people poked you!</p>
            </div>

            <div>
<?                  foreach ($this->session->userdata('show_pokes') as $poke) {
?>                      <p><?= $poke['alias'] ?> poked you <?= $poke['num_pokes'] ?> times  </p> <br>
                    <?php } ?>
            </div>

            <div>
                <p>People you may want to poke:</p>
                <table>
                    <thead>
                        <th>Name</th>
                        <th>Alias</th>
                        <th>Email Address</th>
                        <th>Poke History</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
<?                  foreach ($this->session->userdata('all_users') as $value) {
?>                      <tr>
                            <td> <?= $value['name'] ?> </td>
                            <td> <?= $value['alias'] ?> </td>
                            <td> <?= $value['email'] ?> </td>
                            <td>  </td>
                            <td>    
                                <a href="/users/add_poke/<?=$value['id']?>">Poke</a>
                            </td>

                        </tr>
                    <?php } ?>
                
                </tbody>
                </table>
            </div>    
        </div>
    </body>
</html>















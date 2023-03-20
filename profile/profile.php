<?php
function createProfile($user){
    $name = $user['name'];
    $email = $user['email'] ?? 'None';
    $status = $user['status'] ?? 'None';
    $location = $user['status'] ?? 'Somewhere';
    $sex = $user['sex'] ?? '???';
    $rls = $user['rls'] ?? 'Unspecified';
    $birthday = $user['birthday'] ?? 'Unspecified';
    $hometown = $user['hometown'] ?? 'A place';
    $activites = $user['activites'] ?? 'Something';
    $interests = $user['interests'] ?? 'Unspecified';
    $books = $user['books'] ?? 'Unspecified';
    $quotes = $user['quotes'] ?? 'Nothing';
    $about = $user['about'] ?? 'Someone';
    $education = $user['education'] ?? 'Unspecified';
    $company = $user['company'] ?? 'Unspecified';
    $period = $user['period'] ?? 'Unspecified';
    $work_desc = $user['work_desc'] ?? 'Unspecified';
    ?>
        <div class="welcome fill-available">
            <div class="welcome_header">
            <span><?php echo $name?></span>
            <span><?php echo $status?></span>
            </div>
            <div class="about">
                <div class="left">
                    <img src="<?php echo !isset($user['photo']) || $user['photo'] === '' ? '../resources/default.png' : $user['photo'] ?>" class="profile_photo">
                    <div class="action_div">
                        <a>View photos</a>
                    </div>
                    <div class="action_div">
                        <a>View friends</a>
                    </div>
                    <div class="action_div">
                        <a>Send message</a>
                    </div>
                    <div class="action_div">
                        <a>Poke</a>
                    </div>
                    <div class="action_div">
                        <a>Add as friend</a>
                    </div>
                    <div class="action_div">
                        <a>Report</a>
                    </div>
                    <div class="title_div" style="margin-top: 0.6rem">
                        Status
                    </div>
                    <div class="desc">
                        Is not accepting messages right now...
                    </div>
                </div> 
                <div class="right">
                    <div class="title_div">
                        Information
                    </div>
                    <div class="information">
                        <div class="header_div">
                            Account info
                        </div>
                        <div></div>
                        <div class="info_title">Name: </div>
                        <div class="info"><?php echo $name?></div>
                        <div class="info_title">Networks: </div>
                        <div class="info"><?php implode(',', [$education, $company, $location])?></div>
                        <div class="info_title">Last update: </div>
                        <div class="info">...</div>
                        <div class="header_div">
                            Basic info
                        </div>
                        <div></div>
                        <div class="info_title">Sex: </div>
                        <div class="info"><?php echo $sex?></div>
                        <div class="info_title">Relationship status: </div>
                        <div class="info"><?php echo $rls?></div>
                        <div class="info_title">Residence: </div>
                        <div class="info"><?php echo $location?></div>
                        <div class="info_title">Birthday</div>
                        <div class="info"><?php echo $birthday?></div>
                        <div class="info_title">Hometown: </div>
                        <div class="info"><?php echo $hometown?></div>
                        <div class="header_div">
                            Contact info
                        </div>
                        <div></div>
                        <div class="info_title">Email: </div>
                        <div class="info"><?php echo $email?></div>
                        <div class="header_div">
                            Personal info
                        </div>
                        <div></div>
                        <div class="info_title">Activites: </div>
                        <div class="info"><?php echo $activites?></div>
                        <div class="info_title">Interests: </div>
                        <div class="info"><?php echo $interests?></div>
                        <div class="info_title">Favorite books: </div>
                        <div class="info"><?php echo $books?></div>
                        <div class="info_title">Favorite Quotes: </div>
                        <div class="info"><?php echo $quotes?></div>
                        <div class="info_title">About: </div>
                        <div class="info"><?php echo $about?></div>
                        <div class="header_div">
                            Education info
                        </div>
                        <div></div>
                        <div class="info_title">Education: </div>
                        <div class="info"><?php echo $education?></div>
                        <div class="header_div">
                            Work info
                        </div>
                        <div></div>
                        <div class="info_title">Company: </div>
                        <div class="info"><?php echo $company?></div>
                        <div class="info_title">Time Period: </div>
                        <div class="info"><?php echo $period?></div>
                        <div class="info_title">Description: </div>
                        <div class="info"><?php echo $work_desc?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
?>
<?php
function createProfile($user){
    global $is_my_acc, $my_email;
    $name = $user['name'];
    $email = $user['email'] ?? 'None';
    $status = $user['status'] ?? 'None';
    $location = $user['location'] ?? 'Somewhere';
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
    $work_desc = $user['work_desc'] ?? 'Unspecified';
    $activity_status = $user['activity_status'] ?? 'offline';
    $formatted_date = 'Unspecified';
    if(str_contains($birthday, '-')){
        $date = new DateTime($birthday);
        $formatted_date = $date->format('F jS, o');
    }
    ?>
        <div class="welcome fill-available">
            <div class="welcome_header">
            <span style="text-transform: capitalize"><?php echo $name; echo $is_my_acc ? ' (This is you)' : ''?></span>
            <span><?php echo $status?></span>
            </div>
            <div class="about">
                <div class="left">
                    <img src="<?php echo !isset($user['photo']) || $user['photo'] === '' ? '../resources/default.png' : $user['photo'] ?>" class="profile_photo">
                    <?php
                    if(!isset($user['nonexistent'])){
                        ?>
                        <div class="action_div">
                            <a href="../friends/?user=<?php echo urlencode($email)?>">View friends</a>
                        </div>
                        <?php
                        if(!$is_my_acc){
                            global $db;
                            $friends_table = $db->selectCollection('friends');
                            // check if already added
                            $match = $friends_table->findOne(['friender'=>$my_email, 'friend_email'=>$email]);
                            $text = 'Add as friend';
                            if($match !== null){
                                $text = 'Unfriend';
                            }
                            ?>
                            <div class="action_div">
                                <a>Send message</a>
                            </div>
                            <div class="action_div">
                                <a id="friend_btn"><?php echo $text?></a>
                            </div>
                            <div class="action_div">
                                <a>Report</a>
                            </div>
                            <script src="./scripts/actions.js"></script>
                            <?php
                        }
                    }
                    ?>
                    <div class="title_div" style="margin-top: 0.6rem">
                        Status
                    </div>
                    <div class="desc">
                        <?php echo ucfirst($name)?> is <?php echo $activity_status?> right now.
                    </div>
                </div> 
                <div class="right">
                    <div class="title_div">
                        Information
                    </div>
                    <div class="information" id="def_info">
                        <div class="header_div">
                            Account info
                        </div>
                        <div></div>
                        <div class="info_title">Name: </div>
                        <div class="info" id="profiles_name"><?php echo $name?></div>
                        <div class="info_title">Networks: </div>
                        <div class="info"><?php foreach([$education, $company, $location] as $net) if($net !== 'None') echo $net.'<br>'?></div>
                        <div class="info_title">Last update: </div>
                        <div class="info">...</div>
                        <div class="header_div">
                            Basic info
                        </div>
                        <div></div>
                        <div class="info_title">Sex: </div>
                        <div class="info" id="sex_def"><?php echo $sex?></div>
                        <div class="info_title">Relationship status: </div>
                        <div class="info" id="rls_def"><?php echo $rls?></div>
                        <div class="info_title">Residence: </div>
                        <div class="info" id="location_def"><?php echo $location?></div>
                        <div class="info_title">Birthday</div>
                        <div class="info birthdayDef" value="<?php echo $birthday?>"><?php echo $formatted_date?></div>
                        <div class="info_title">Hometown: </div>
                        <div class="info" id="hometown_def"><?php echo $hometown?></div>
                        <div class="header_div">
                            Contact info
                        </div>
                        <div></div>
                        <div class="info_title">Email: </div>
                        <div class="info emailInfo" style="text-transform: none;" id="profiles_email"><?php echo $email?></div>
                        <div class="header_div">
                            Personal info
                        </div>
                        <div></div>
                        <div class="info_title">Activites: </div>
                        <div class="info" id="activites_def"><?php echo $activites?></div>
                        <div class="info_title">Interests: </div>
                        <div class="info" id="interests_def"><?php echo $interests?></div>
                        <div class="info_title">Favorite books: </div>
                        <div class="info" id="books_def"><?php echo $books?></div>
                        <div class="info_title">Favorite Quotes: </div>
                        <div class="info" id="quotes_def"><?php echo $quotes?></div>
                        <div class="info_title">About: </div>
                        <div class="info" id="about_def"><?php echo $about?></div>
                        <div class="header_div">
                            Education info
                        </div>
                        <div></div>
                        <div class="info_title">Education: </div>
                        <div class="info" id="education_def"><?php echo $education?></div>
                        <div class="header_div">
                            Work info
                        </div>
                        <div></div>
                        <div class="info_title">Company: </div>
                        <div class="info" id="company_def"><?php echo $company?></div>
                        <div class="info_title">Description: </div>
                        <div class="info" id="work_desc_def"><?php echo $work_desc?></div>
                    </div>
                    <?php
                    if($is_my_acc){
                        ?>
                        <div class="edit-div">
                            <div class="information" style="grid-row-gap: 0.4rem">
                            <div class="header_div">
                                Basic info
                            </div>
                            <div></div>
                            <div class="info_title">Sex: </div>
                            <div class="info">
                                <select id="sex_edit">
                                    <?php
                                    $options = ['unspecified', 'male', 'female', 'other'];
                                    foreach($options as $opt){
                                        ?>
                                        <option value="<?php echo $opt?>" <?php if($opt === $sex) echo 'selected'?>><?php echo ucfirst($opt)?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="info_title">Relationship status: </div>
                            <div class="info">
                                <select id="rls_edit">
                                    <?php
                                    $options = ['unspecified', 'single', 'looking', 'taken'];
                                    foreach($options as $opt){
                                        ?>
                                        <option value="<?php echo $opt?>" <?php if($opt === $rls) echo 'selected'?>><?php echo ucfirst($opt)?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="info_title">Residence: </div>
                            <div class="info"><input value="<?php echo $location?>" id="location_edit"></div>
                            <div class="info_title">Birthday</div>
                            <div class="info"><input type="date" <?php if(strtolower($birthday) !== 'unspecified') {?> value="<?php echo $birthday?>" <?php } ?> id="birthday_edit"></div>
                            <div class="info_title">Hometown: </div>
                            <div class="info"><input value="<?php echo $hometown?>" id="hometown_edit"></div>
                            <div class="header_div">
                                Personal info
                            </div>
                            <div></div>
                            <div class="info_title">Activites: </div>
                            <div class="info"><input value="<?php echo $activites?>" id="activites_edit"></div>
                            <div class="info_title">Interests: </div>
                            <div class="info"><input value="<?php echo $interests?>" id="interests_edit"></div>
                            <div class="info_title">Favorite books: </div>
                            <div class="info"><input value="<?php echo $books?>" id="books_edit"></div>
                            <div class="info_title">Favorite Quotes: </div>
                            <div class="info"><input value="<?php echo $quotes?>" id="quotes_edit"></div>
                            <div class="info_title">About: </div>
                            <div class="info"><input value="<?php echo $about?>" id="about_edit"></div>
                            <div class="header_div">
                                Education info
                            </div>
                            <div></div>
                            <div class="info_title">Education: </div>
                            <div class="info"><input value="<?php echo $education?>" id="education_edit"></div>
                            <div class="header_div">
                                Work info
                            </div>
                            <div></div>
                            <div class="info_title">Company: </div>
                            <div class="info"><input value="<?php echo $company?>" id="company_edit"></div>
                            <div class="info_title">Description: </div>
                            <div class="info"><input value="<?php echo $work_desc?>" id="work_desc_edit"></div>
                            <button id="save-edit" class="classic-btn" style="margin-top: 1rem">Save</button>
                            <button id="close-edit" class="classic-btn" style="margin-top: 1rem">Close</button>
                        </div>
                        </div>
                        <script src="./scripts/edit.js"></script>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
}
?>

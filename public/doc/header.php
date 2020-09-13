<?php if(!empty($error)):?>
    <div>
        <ul>
            <?php foreach ($error as $v): ?>
                <li>
                    <?php echo $v;?>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>
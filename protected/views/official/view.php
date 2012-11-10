<div class="container row-fluid">
    <div class="profile" >
        <div class="row official-adaptive-view">
        <img src="<?php echo $official->getImage(); ?>" class="official-photo span4" alt="official-photo" />
        <h2 class="span7"><?php echo $official->LastName . ' ' . $official->FirstName . ' ' . $official->MiddleName;?></h2>
            <h5 class="span7"><em><?php echo $official->Post;?></em></h5>
            <div class="span7"><b>Департамент</b> : <span><?php echo $official->Departament;?></span></div>
            <div class="span7"><b>Область</b> : <span><?php echo $official->region->Name;?></span></div>
            <div class="span7"><b>Мiсто</b> : <span><?php echo $official->city->Name;?></span></div>
        <button class="btn btn-large btn-primary official-review" type="button">Залишити відгук</button>
        </div>
        <div class="row official-adaptive-view">
        <dl class="span12">
            <?php foreach( $criteriaEstimates as $criteriaEstimate ): ?>
                <div class="span5">
                    <dt>
                         <?php echo $criteriaEstimate['Name']; ?>
                     </dt>
                     <dd>
                     <div class="progress progress-success">
                         <div class="bar" style="width: <?php echo $criteriaEstimate['Value'];?>% "></div>
                     </div>
                     </dd>
                 </div>
            <?php endforeach;?>
        </dl>
        
        </div>
        <div class="row official-adaptive-view">
        <div class="tabbable">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Відгуки</a></li>
            <li><a href="#tab2" data-toggle="tab">Біографія</a></li>
            <li><a href="#tab3" data-toggle="tab">Декларація</a></li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <?php foreach( $reviews as $review ):?>
                    <div class="span12">
                        <span><b><?php echo empty( $review->AuthorName ) ? Yii::t( 'application', 'Anonim' ) : $review->AuthorName; ?></b></span>
                        <span class="pull-right"><b><?php echo date( 'h:i:s d-m-Y', strtotime( $review->Timestamp ) ); ?></b></span>
                        <div><?php echo $review->Text; ?></div>
                        <hr />
                    </div>
                <?php endforeach;?>
            </div>
            <div class="tab-pane" id="tab2">
                <p><?php echo $official->Description; ?></p>
            </div>
            <div class="tab-pane" id="tab2">
                <p>Посилання на декларацію</p>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>

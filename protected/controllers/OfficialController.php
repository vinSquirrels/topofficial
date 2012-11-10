<?php
class OfficialController extends Controller {
    public function actionView() {
        $id = isset( $_GET[ 'id' ] ) ? (integer) $_GET[ 'id' ] : null;
        $official = Official::model()->findByPk( $id );
        $criteriaEstimates = $official->getCriteriaEstimates();
        $rankValue = $official->getRank();
        print_r( $rankValue );die;
        $this->render( 
            'view', 
            array(
                'official' => $official,
                'criteriaEstimates' => $criteriaEstimates,
                'rankValue' => $rankValue
            )
        );
    }
}
?>

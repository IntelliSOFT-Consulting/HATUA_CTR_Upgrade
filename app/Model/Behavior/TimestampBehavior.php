<?php

class TimestampBehavior extends ModelBehavior {

    public function beforeSave(Model $model, $options = array()) {
        $currentTime = date('Y-m-d H:i:s');
        $model->data[$model->alias]['modified'] = $currentTime;

        if (!$model->exists()) {
            // New record, set the 'created' field
            if (!isset($model->data[$model->alias]['created'])) {
                $model->data[$model->alias]['created'] = $currentTime;
            }
        } 

        return true; // Allow the save operation to continue
    }

}
<?php
function get_course_image()
{
   global $COURSE;
   $url = '';
   require_once( 'C:\xampp\htdocs\moodleacatdemi\lib\filelib.php' );

   $context = context_course::instance( $COURSE->id );
   $fs = get_file_storage();
   $files = $fs->get_area_files( $context->id, 'course', 'overviewfiles', 0 );

   foreach ( $files as $f )
   {
     if ( $f->is_valid_image() )
     {
        $url = moodle_url::make_pluginfile_url( $f->get_contextid(), $f->get_component(), $f->get_filearea(), null, $f->get_filepath(), $f->get_filename(), false );
     }
   }

   return $url;
}
?>
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posts;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = Posts::create([
            'user_id' => 1,
            'category_id' => 1,
            'slug' => 'lorem-ipsum',
            'judul' => 'Lorem Ipsum',
            'cover' => '1640393524-photo4.jpg',
            'ringkasan' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Massa tempor nec feugiat nisl pretium fusce id velit. Lacinia at quis risus sed vulputate odio ut. Sed velit dignissim sodales.',
            'isi' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Massa tempor nec feugiat nisl pretium fusce id velit. Lacinia at quis risus sed vulputate odio ut. Sed velit dignissim sodales ut eu sem integer vitae justo. Et egestas quis ipsum suspendisse ultrices gravida dictum. Urna nec tincidunt praesent semper feugiat nibh sed. Ut faucibus pulvinar elementum integer enim neque volutpat. Diam maecenas sed enim ut sem viverra aliquet. Lobortis scelerisque fermentum dui faucibus in ornare quam viverra. Nec ultrices dui sapien eget mi proin sed libero. In massa tempor nec feugiat nisl pretium fusce id velit. Gravida dictum fusce ut placerat orci nulla. Iaculis eu non diam phasellus vestibulum. Non sodales neque sodales ut. Magna sit amet purus gravida quis blandit turpis cursus. Egestas purus viverra accumsan in nisl nisi scelerisque eu. A arcu cursus vitae congue mauris. Nunc faucibus a pellentesque sit amet porttitor eget dolor. Odio euismod lacinia at quis risus sed vulputate odio ut.</p>
            <h2>Lorem Ipsum 2</h2>
            <p><img src="/storage/photos/shares/photo1.jpg" alt="" width="300" height="199" /></p>
            <p>Elit duis tristique sollicitudin nibh sit. Sed risus pretium quam vulputate dignissim suspendisse in. Enim eu turpis egestas pretium aenean pharetra magna. At consectetur lorem donec massa sapien faucibus. Morbi tincidunt ornare massa eget egestas purus viverra accumsan in. Et netus et malesuada fames. Blandit libero volutpat sed cras ornare arcu. Vulputate enim nulla aliquet porttitor lacus luctus accumsan tortor posuere. Tempor commodo ullamcorper a lacus. Sed risus pretium quam vulputate dignissim. Etiam erat velit scelerisque in dictum non. Etiam erat velit scelerisque in dictum non. Tincidunt arcu non sodales neque. Cursus vitae congue mauris rhoncus aenean vel. Sit amet consectetur adipiscing elit ut aliquam purus sit.</p>
            <p>Egestas fringilla phasellus faucibus scelerisque eleifend donec. Ut lectus arcu bibendum at varius. Nullam vehicula ipsum a arcu cursus. Netus et malesuada fames ac turpis egestas integer eget aliquet. Vel eros donec ac odio tempor orci dapibus ultrices in. Amet massa vitae tortor condimentum lacinia quis vel. Dui faucibus in ornare quam viverra orci sagittis eu. In fermentum et sollicitudin ac orci phasellus. Rhoncus mattis rhoncus urna neque. Cras ornare arcu dui vivamus arcu felis. Consectetur a erat nam at lectus urna. Faucibus scelerisque eleifend donec pretium. Tellus in hac habitasse platea dictumst vestibulum rhoncus. Eu feugiat pretium nibh ipsum. Tellus mauris a diam maecenas sed enim ut. Ut porttitor leo a diam sollicitudin tempor.</p>
            <p>Massa eget egestas purus viverra accumsan in nisl. Accumsan in nisl nisi scelerisque. Semper quis lectus nulla at volutpat. Amet mauris commodo quis imperdiet massa tincidunt nunc. Odio euismod lacinia at quis risus. Gravida in fermentum et sollicitudin ac orci phasellus egestas tellus. Odio pellentesque diam volutpat commodo sed egestas. Amet nulla facilisi morbi tempus iaculis urna id volutpat lacus. Tincidunt praesent semper feugiat nibh sed pulvinar proin gravida hendrerit. Neque sodales ut etiam sit amet. In mollis nunc sed id semper. Fermentum posuere urna nec tincidunt. Nulla at volutpat diam ut venenatis tellus in metus vulputate. Elit at imperdiet dui accumsan sit. Lacinia quis vel eros donec ac odio tempor. Sed tempus urna et pharetra pharetra massa. Nam libero justo laoreet sit. Eu volutpat odio facilisis mauris sit amet massa. Integer vitae justo eget magna fermentum. Aliquam malesuada bibendum arcu vitae elementum curabitur vitae.</p>
            <p>Odio eu feugiat pretium nibh ipsum consequat nisl vel pretium. Non consectetur a erat nam at lectus. Quisque non tellus orci ac auctor. Vitae turpis massa sed elementum tempus egestas. Egestas dui id ornare arcu odio ut sem nulla pharetra. Sit amet venenatis urna cursus eget nunc scelerisque viverra mauris. Interdum velit euismod in pellentesque massa. Cursus risus at ultrices mi tempus imperdiet nulla. Lorem ipsum dolor sit amet consectetur adipiscing elit. Feugiat in fermentum posuere urna nec tincidunt praesent semper feugiat. Sed faucibus turpis in eu. Urna nunc id cursus metus aliquam eleifend mi in nulla. Non enim praesent elementum facilisis.</p>
            <pre class="language-python"><code>print("lorem ipsum")</code></pre>',
            'keywords' => 'lorem, ipsum'
        ]);
    }
}

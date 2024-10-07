namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Sample categories data
        $categories = [
            // Root categories
            [
                'name' => 'Articles',
                'slug' => 'articles',
                'description' => 'Various articles on technology and programming.',
                'parent_id' => null,
            ],
            [
                'name' => 'Courses',
                'slug' => 'courses',
                'description' => 'Educational courses on various topics.',
                'parent_id' => null,
            ],
            // Subcategories for Articles
            [
                'name' => 'Backend',
                'slug' => 'backend',
                'description' => 'Backend development articles.',
                'parent_id' => 1, // Parent ID for 'Articles'
            ],
            [
                'name' => 'Frontend',
                'slug' => 'frontend',
                'description' => 'Frontend development articles.',
                'parent_id' => 1, // Parent ID for 'Articles'
            ],
            [
                'name' => 'AI',
                'slug' => 'ai',
                'description' => 'Artificial Intelligence articles.',
                'parent_id' => 1, // Parent ID for 'Articles'
            ],
            [
                'name' => 'Networking',
                'slug' => 'networking',
                'description' => 'Networking articles.',
                'parent_id' => 1, // Parent ID for 'Articles'
            ],
            // Subcategories for Backend
            [
                'name' => 'PHP',
                'slug' => 'php',
                'description' => 'Articles on PHP programming.',
                'icon' => 'fa-code',
                'parent_id' => 3, // Parent ID for 'Backend'
            ],
            [
                'name' => 'MySQL',
                'slug' => 'mysql',
                'description' => 'Articles on MySQL databases.',
                'parent_id' => 3, // Parent ID for 'Backend'
            ],
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'Articles on Laravel framework.',
                'parent_id' => 3, // Parent ID for 'Backend'
            ],
            // Subcategories for Frontend
            [
                'name' => 'HTML',
                'slug' => 'html',
                'description' => 'Articles on HTML development.',
                'parent_id' => 4, // Parent ID for 'Frontend'
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'description' => 'Articles on JavaScript programming.',
                'parent_id' => 4, // Parent ID for 'Frontend'
            ],
            [
                'name' => 'Frameworks',
                'slug' => 'frameworks',
                'description' => 'Frontend frameworks.',
                'parent_id' => 4, // Parent ID for 'Frontend'
            ],
            // Subcategories for Frameworks
            [
                'name' => 'React',
                'slug' => 'react',
                'description' => 'Articles on React framework.',
                'parent_id' => 10, // Parent ID for 'Frameworks'
            ],
            [
                'name' => 'Vue',
                'slug' => 'vue',
                'description' => 'Articles on Vue framework.',
                'parent_id' => 10, // Parent ID for 'Frameworks'
            ],
            // Subcategories for Courses
            [
                'name' => 'PHP Course',
                'slug' => 'php-course',
                'description' => 'Learn PHP programming.',
                'parent_id' => 2, // Parent ID for 'Courses'
            ],
            [
                'name' => 'JavaScript Course',
                'slug' => 'javascript-course',
                'description' => 'Learn JavaScript programming.',
                'parent_id' => 2, // Parent ID for 'Courses'
            ],
        ];

        // Insert categories into the database
        DB::table('categories')->insert($categories);
    }
}

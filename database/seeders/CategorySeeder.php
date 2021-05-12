<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //         $categories = [
        //             [
        //                 'id' => 1, 'name' => 'Artworks', 'url' => 'art', 'parent_id' => null,
        //                 'meta_desc' => "We don't read and write poetry because it's cute. We read and write poetry because we are members of the human race. And the human race is filled with passion. And medicine, law, business, engineering, these are noble pursuits and necessary to sustain life. But poetry, beauty, romance, love, these are what we stay alive for. - Dead Poets Society"
        //             ],
        //             [
        //                 'id' => 2, 'name' => 'Home Decor', 'url' => 'home-decor', 'parent_id' => null,
        //                 'meta_desc' => "Only a soul can make your house feel like home. Nurture that soul with art. Find unique products to
        //                 artify your home."
        //             ],
        //             [
        //                 'id' => 3, 'name' => 'Clothing & Accessories', 'url' => 'accessories', 'parent_id' => null,
        //                 'meta_desc' => "Artify your wardrobe with our all new collections."
        //             ],
        //             [
        //                 'id' => 4, 'name' => 'Gifts', 'url' => 'gifts', 'parent_id' => null,
        //                 'meta_desc' => "Nothing says it more personally than hand-made gifts."
        //             ],

        //             [
        //                 'id' => 5, 'name' => 'Traditional Art', 'url' => 'traditional-art', 'parent_id' => 1,
        //                 'meta_desc' => "Many traditional arts are a part of our diverse culture, skills and knowledge of which are passed
        //                 down through generations from master craftsmen to apprentices. "
        //             ],
        //             [
        //                 'id' => 6, 'name' => 'Modern Art', 'url' => 'modern-art', 'parent_id' => 1,
        //                 'meta_desc' => "Modern art denotes the styles and philosophy of artworks created during 1860s to the 1970s. The term is
        //                 usually associated with art in which the traditions of the past have been thrown aside in a spirit of experimentation."
        //             ],
        //             [
        //                 'id' => 7, 'name' => 'Contemporary Art', 'url' => 'contemporary-art', 'parent_id' => 1,
        //                 'meta_desc' => "Contemporary Art meaning “the art of today,” more broadly includes artwork produced during the late 20th and
        //                 early 21st centuries. It generally defines art produced after the Modern Art movement to the present day."
        //             ],
        //             [
        //                 'id' => 8, 'name' => 'New Art', 'url' => 'new-art', 'parent_id' => 1,
        //                 'meta_desc' => "The newer artstyles that have evolved into existence."
        //             ],

        //             [
        //                 'id' => 9, 'name' => 'Madhubani', 'url' => 'madhubani', 'parent_id' => 5,
        //                 'meta_desc' => "Madhubani art is a traditional folk art style. Also called the mithila art, these paintings
        //                 are so beautifully detailed and don't leave any empty gaps. These are often made on
        //                 cloth, canvas and cow dung paper."
        //             ],
        //             [
        //                 'id' => 10, 'name' => 'Rajasthani', 'url' => 'rajasthani', 'parent_id' => 5,
        //                 'meta_desc' => "Rajasthani style of painting, evolved and flourished in the royal courts of Rajputan in northern India,
        //                 mainly during the 17th and 18th centuries."
        //             ],
        //             [
        //                 'id' => 11, 'name' => 'Folk', 'url' => 'folk', 'parent_id' => 5,
        //                 'meta_desc' => "Folk art often reflects the cultural life of one community and encompasses their true
        //                 folklore and artistic identity."
        //             ],
        //             [
        //                 'id' => 12, 'name' => 'Tribal', 'url' => 'tribal', 'parent_id' => 5,
        //                 'meta_desc' => "Tribal art is often made by indigenous people from rural areas. These
        //                 often reflect their cultural vibrancy by their cultural arts."
        //             ],
        //             [
        //                 'id' => 13, 'name' => 'Phad', 'url' => 'phad', 'parent_id' => 5,
        //                 'meta_desc' => "An indigenous painting style, originated in Rajasthan, depicts the narratives of folklore
        //                 and stories of local epics. These paintings are very detailed and ever beautiful."
        //             ],
        //             [
        //                 'id' => 14, 'name' => 'Warli', 'url' => 'warli', 'parent_id' => 5,
        //                 'meta_desc' => "Warli art is one of the most ancient Indian folk art forms. These are originated from the
        //                 warli region of maharashtra and are beautifully depicted and usually make use of
        //                 geometric shapes and figures."
        //             ],
        //             [
        //                 'id' => 15, 'name' => 'Patachitra', 'url' => 'patachitra', 'parent_id' => 5,
        //                 'meta_desc' => "Pattachitra or Patachitra is a general term for traditional, cloth-based scroll painting,
        //                 based in the eastern Indian states of Odisha and West Bengal. Pattachitra artform is known for its intricate
        //                 details as well as mythological narratives and folktales inscribed in it."
        //             ],
        //             [
        //                 'id' => 16, 'name' => 'Tanjore', 'url' => 'tanjore', 'parent_id' => 5,
        //                 'meta_desc' => "Tanjore art is a south indian style of painting and is a manifestation of true art. Rich
        //                     colours, elementary combinations, glittering gold foil work with glass beads are often
        //                     used."
        //             ],
        //             [
        //                 'id' => 17, 'name' => 'Kalamazhuthu', 'url' => 'kalamezhuthu', 'parent_id' => 5,
        //                 'meta_desc' => "The art form of kalamezhuthu is from Kerala and is a long drawn out process. These
        //                     often tell the tale of deities of the state and the cultural narrative."
        //             ],
        //             [
        //                 'id' => 18, 'name' => 'Gond', 'url' => 'gond', 'parent_id' => 5,
        //                 'meta_desc' => "This traditional art form of painting found its roots in one of the largest tribes, Gond.
        //                 These paintings take inspiration from natural elements and mostly Trees, animals, birds
        //                 and other environmental representations are probably the most identifiable subject
        //                 matter.",
        //             ],

        //             [
        //                 'id' => 19, 'name' => 'Miniature Art', 'url' => 'miniature-art', 'parent_id' => 5,
        //                 'meta_desc' => " A piece of miniature art can be held in the palm of the hand, or that it covers less
        //                 than 25 square inches or 100 cm²."
        //             ],
        //             [
        //                 'id' => 20, 'name' => 'Kalamkari', 'url' => 'kalamkari', 'parent_id' => 5,
        //                 'meta_desc' => "Kalamkari is a hand printing or block printing painting
        //                 style. These are produced in the states of Telangana and Andra Pradesh, and are done on
        //                     cotton or silk fabric."
        //             ],
        //             [
        //                 'id' => 21, 'name' => 'Cheriyal Scrolls', 'url' => 'cheriyal-scrolls', 'parent_id' => 5,
        //                 'meta_desc' => "Cheriyal scrolls are modernized versions of Nashkari
        //                 art. The scrolls are painted in a narrative format, much like a film roll or a comic strip,
        //                 depicting stories from Indian mythology, and intimately tied to the shorter stories from the Puranas and Epics."
        //             ],
        //             [
        //                 'id' => 22, 'name' => 'Kalighat Painting', 'url' => 'kalighat-painting', 'parent_id' => 5,
        //                 'meta_desc' => "kalighat paintings Originating from the state of west bengal, they use bright colours and bold outlines to make them more
        //                 sublime."
        //             ],
        //             [
        //                 'id' => 23, 'name' => 'Picchwal', 'url' => 'picchwal', 'parent_id' => 5,
        //                 'meta_desc' => "Pichwai are sacred Hindu paintings that originated in Rajasthan nearly 400 years ago.
        //                 These are sublime and visually stunning and depict the tales and epics of Lord Krishna."
        //             ],
        //             [
        //                 'id' => 24, 'name' => 'Kerala Murals', 'url' => 'kerala-murals', 'parent_id' => 5,
        //                 'meta_desc' => "Kerala mural paintings are paintings that depict hindu mythology and legends. These are
        //                 often made in holy places in south india, particularly in kerala."
        //             ],
        //             [
        //                 'id' => 25, 'name' => 'Dhokra Art', 'url' => 'dhokra-art', 'parent_id' => 5,
        //                 'meta_desc' => "The dhokra art is indigenous to tribal Orissa. This art roots back to the Indus valley
        //                 civilization and is a non ferrous metal casting technique."
        //             ],
        //             [
        //                 'id' => 74, 'name' => 'Bidri Art', 'url' => 'bidri-art', 'parent_id' => 5,
        //                 'meta_desc' => "Bidriware is a metal handicraft from Bidar. It was developed in the 14th century C.E. during the
        //                 rule of the Bahamani Sultans. The metal used is a blackened alloy of zinc and copper inlaid with thin sheets of pure silver."
        //             ],

        //             [
        //                 'id' => 26, 'name' => 'Abstract Art', 'url' => 'abstract-art', 'parent_id' => 6,
        //                 'meta_desc' => "modern art precisely doesn't attempt to visualize a particular
        //                 reality but instead uses shapes, figures, colours and lines to create its effect."
        //             ],
        //             [
        //                 'id' => 27, 'name' => 'Concept Art', 'url' => 'concept-art', 'parent_id' => 6,
        //                 'meta_desc' => "Out of the box art."
        //             ],
        //             [
        //                 'id' => 28, 'name' => 'Pattern/Design', 'url' => 'pattern-design', 'parent_id' => 6,
        //                 'meta_desc' => "This visually stunning art form makes repetitive use of the same lines, shapes and
        //                 colours. These parrots have specific visual elements and are truly sublime."
        //             ],
        //             [
        //                 'id' => 29, 'name' => 'Minimalistic', 'url' => 'minimalistic', 'parent_id' => 6,
        //                 'meta_desc' => "In visual arts, music, and other media, minimalism is an art movement that began in
        //                 post–World War II Western art, most strongly with American visual arts in the 1960s and early 1970s."
        //             ],
        //             [
        //                 'id' => 30, 'name' => 'Figurative', 'url' => 'figurative', 'parent_id' => 6,
        //                 'meta_desc' => "These are visually stunning paintings that are inspired from real life objects and thus
        //                 representational in nature."
        //             ],
        //             [
        //                 'id' => 31, 'name' => 'Panel', 'url' => 'panel', 'parent_id' => 6,
        //                 'meta_desc' => "These are paintings made on a flat wood, canvas panel. These can be made on a single
        //                 piece or on multiple pieces combined together. These are intricate wall art which
        //                 definitely adds royalty and class to your home."
        //             ],
        //             [
        //                 'id' => 32, 'name' => 'Digital Art', 'url' => 'digital-art', 'parent_id' => 6,
        //                 'meta_desc' => "Digital art is an artistic work or practice that uses digital technology as part of
        //                 the creative or presentation process."
        //             ],
        //             [
        //                 'id' => 33, 'name' => 'Impasto/Texture', 'url' => 'impasto-texture', 'parent_id' => 6,
        //                 'meta_desc' => "This modern style of art is a technique where paint is laid onto a surface thickly
        //                 so that it holds the imprint of an artist’s brush or palette knife. These are truly
        //                 sublime and intricate."
        //             ],
        //             [
        //                 'id' => 34, 'name' => 'Doodle Art', 'url' => 'doodle-art', 'parent_id' => 6,
        //                 'meta_desc' => "doodling is effortless and simple drawings that can have concrete representational
        //                 meaning or may just be composed of random and abstract lines. This is a fun way
        //                 of drawing and comes out to be extremely cute and appealing."
        //             ],
        //             [
        //                 'id' => 35, 'name' => 'Gothic Art', 'url' => 'gothic-art', 'parent_id' => 6,
        //                 'meta_desc' => "This is a medieval art form that originated in France. Though it does vary from
        //                 location to location but mostly put emphasis on curving lines, details, refined
        //                 decoration and gold."
        //             ],

        //             [
        //                 'id' => 36, 'name' => 'Landscapes', 'url' => 'landscapes', 'parent_id' => 7,
        //                 'meta_desc' => "Landscapes are nothing but a depiction of natural scenery. These often include sublime
        //                 trees, forest, fields, water and etc. These can have both a complex colour coordination
        //                 and also a simple harmony or earthly colours."
        //             ],
        //             [
        //                 'id' => 37, 'name' => 'Seascopes', 'url' => 'seascopes', 'parent_id' => 7,
        //                 'meta_desc' => "These are a type of marine art that depicts the sea. These are truly beautiful. The colour
        //                     combination can be complex or simple and often uses the shades of blue."
        //             ],
        //             [
        //                 'id' => 38, 'name' => 'Silhoutte', 'url' => 'silhoutte', 'parent_id' => 7,
        //                 'meta_desc' => "This type of art is the objects often stand out of the shadows. The image in the centre is
        //                 rendered in a single colour, in this type of painting. Beautiful and bright colours are used
        //                 in the background."
        //             ],
        //             [
        //                 'id' => 39, 'name' => 'Floral Art', 'url' => 'floral-art', 'parent_id' => 7,
        //                 'meta_desc' => "This is yet another eye-catching contemporary artform in which plant materials and
        //                 flowers are usually made. Bright colours and a balanced composition is often used in this
        //                 type of art."
        //             ],
        //             [
        //                 'id' => 40, 'name' => 'Clay Art', 'url' => 'clay-art', 'parent_id' => 7,
        //                 'meta_desc' => "It is simply making things out of clay. This type of art can take many forms from
        //                 paintings to artistic pottery."
        //             ],
        //             [
        //                 'id' => 41, 'name' => 'Realistic Art', 'url' => 'realistic-art', 'parent_id' => 7,
        //                 'meta_desc' => "These are characterized by subjects from day to day life in the
        //                 most real manner. These paintings are made in a photographic way."
        //             ],
        //             [
        //                 'id' => 42, 'name' => 'Psychedelic Art', 'url' => 'psychedelic-art', 'parent_id' => 7,
        //                 'meta_desc' => "Psychedelic art is art, graphics or visual displays related to or inspired
        //                 by psychedelic experiences. Any art that is triggered by manifestation of the inner world, these
        //                 are intricate artworks with bright colours, which are often crazy and mysterious."
        //             ],
        //             [
        //                 'id' => 43, 'name' => 'Still-life', 'url' => 'still-life', 'parent_id' => 7,
        //                 'meta_desc' => "This type of painting is characterized by painting still objects. Different types of form,
        //                 colour, texture, and composition are often used."
        //             ],
        //             [
        //                 'id' => 44, 'name' => 'Mandala', 'url' => 'mandala', 'parent_id' => 7,
        //                 'meta_desc' => "These paintings have a center point and then a circular pattern around it.
        //                 The essence of it is the connection between the outer world and inner realities."
        //             ],
        //             [
        //                 'id' => 45, 'name' => 'Sketches', 'url' => 'sketches', 'parent_id' => 7,
        //                 'meta_desc' => "Sketch art form is one of the most common and primary artforms. Traditionally, these
        //                 are rough ideas of the artists that eventually are worked upon as detailed and intricate
        //                 artwork."
        //             ],
        //             [
        //                 'id' => 46, 'name' => 'Anatomy', 'url' => 'anatomy', 'parent_id' => 7,
        //                 'meta_desc' => "Just as the name suggests this artform amalgamates art and science. Thus it is the
        //                 artistic expression of the structural form of life, and specifically life in human anatomy."
        //             ],


        //             [
        //                 'id' => 47, 'name' => 'Stone Art', 'url' => 'stone-art', 'parent_id' => 8,
        //                 'meta_desc' => "Stone art is simply the art that rocks! Painting stones and rocks is not much different
        //                 than painting paper, canvas, or walls and the idea is to keep it fun and simple."
        //             ],
        //             [
        //                 'id' => 48, 'name' => 'String Art', 'url' => 'string-art', 'parent_id' => 8,
        //                 'meta_desc' => "This type of art form is a new age art form where String art or pin and thread art, is
        //                     characterized by an arrangement of colored thread strung between points to form
        //                 representational designs and simple or geometric patterns."
        //             ],
        //             [
        //                 'id' => 49, 'name' => 'Alcohol Art', 'url' => 'alcohol-art', 'parent_id' => 8,
        //                 'meta_desc' => "In alcohol art use of bright colour dye color paints based on alcohol.
        //                 These usually create free and flowy textures."
        //             ],
        //             [
        //                 'id' => 50, 'name' => 'Resin Art', 'url' => 'resin-art', 'parent_id' => 8,
        //                 'meta_desc' => "Resin art is created mixing the two components,and then the liquid resin gradually
        //                     hardens to a solid plastic, due to the chemical reaction resulting in a high-gloss, clear
        //                     surface."
        //             ],
        //             [
        //                 'id' => 51, 'name' => 'Dot Art', 'url' => 'dot-art', 'parent_id' => 8,
        //                 'meta_desc' => "Just like the name suggests, dot art is a technique of painting where small and definite
        //                     dots of color are applied in patterns to form an image."
        //             ],

        //             [
        //                 'id' => 52, 'name' => 'Carpets', 'url' => 'carpets', 'parent_id' => 2,
        //                 'meta_desc' => "A home is definitely incomplete without a carpet or rug. It beautifies the place and
        //                     enhances the look of your room and the feel of any interior space."
        //             ],
        //             [
        //                 'id' => 53, 'name' => 'Cushions', 'url' => 'cushions', 'parent_id' => 2,
        //                 'meta_desc' => "Cushion covers are yet another contemporary and chic home decor that adds to the
        //                 class and makes your interior space look immediately beautiful."
        //             ],
        //             [
        //                 'id' => 54, 'name' => 'Macrames', 'url' => 'macrames', 'parent_id' => 2,
        //                 'meta_desc' => "Macrame is a crafting and artistic technique that uses knots to create various
        //                 textiles."
        //             ],
        //             [
        //                 'id' => 55, 'name' => 'Dream Catchers', 'url' => 'dream-catchers', 'parent_id' => 2,
        //                 'meta_desc' => "A dream catcher is a handmade willow hoop, on which a net or web is woven which can
        //                     be made in different colours, styles and size. Different feathers, stones, wind chimes, or
        //                     beads can also be used to further beautify the dream catchers."
        //             ],
        //             [
        //                 'id' => 56, 'name' => 'Bottle Art', 'url' => 'bottle-art', 'parent_id' => 2,
        //                 'meta_desc' => "Anything can be converted into artwork with a creative mind. In bottle artwork Bottles
        //                 are painted and used as décor items. Thus creating old glass bottles into creative and
        //                 colourful vases or decorative artworks."
        //             ],
        //             [
        //                 'id' => 57, 'name' => 'Coasters', 'url' => 'coasters', 'parent_id' => 2,
        //                 'meta_desc' => "Even though small yet coasters are smart to enhance the looks of a coffee table or a
        //                 dining table. These are type of home decors which are simple yet gives an elegant look to
        //                 you interior space."
        //             ],
        //             [
        //                 'id' => 58, 'name' => 'Name-Plates', 'url' => 'name-plates', 'parent_id' => 2,
        //                 'meta_desc' => "a small panel on or next to the door of a room or building, bearing the occupant's name
        //                 and profession with a classy look in creative manner."
        //             ],
        //             [
        //                 'id' => 59, 'name' => 'Key-Holder', 'url' => 'key-holder', 'parent_id' => 2,
        //                 'meta_desc' => "Key holders are an essential requirement so why not make it chic and classy. We have a
        //                 wide range of key holders to make your interior space just a little artistic."
        //             ],
        //             [
        //                 'id' => 60, 'name' => 'Ash Tray', 'url' => 'ash-tray', 'parent_id' => 2,
        //                 'meta_desc' => "An ashtray is a receptacle for ash from cigarettes and cigars. why not an ARTISTIC ash
        //                 tray to give a classy look on your table or home."
        //             ],

        //             [
        //                 'id' => 61, 'name' => 'T-shirts', 'url' => 't-shirts', 'parent_id' => 3,
        //                 'meta_desc' => "It can be hard to articulate the power of style and fashion through words. T Shirts are just the
        //                 way to keep it cool and chic at the same time. So why not be ARTISTIC."
        //             ],
        //             [
        //                 'id' => 62, 'name' => 'Sarees', 'url' => 'sarees', 'parent_id' => 3,
        //                 'meta_desc' => "What was worn traditionally, has become a fashion statement now. Sarees have been loved
        //             by myriads of women. The true significance of the saree lies in the management of such a
        //             huge piece of cloth in such an elegant way."
        //             ],
        //             [
        //                 'id' => 63, 'name' => 'Jewellery', 'url' => 'jewellery', 'parent_id' => 3,
        //                 'meta_desc' => "A fitting piece of jewellery traditionally goes with every milestone. It often forms a part of the
        // people and adds that little extra elegance and beauty when worn."
        //             ],
        //             [
        //                 'id' => 64, 'name' => 'Shoes', 'url' => 'shoes', 'parent_id' => 3,
        //                 'meta_desc' => "Shoes have more just a functional meaning to them now. They have definitely become a
        // fashion statement. Vogue and shoes go hand in hand and add just the final touch to your
        // look."
        //             ],

        //             [
        //                 'id' => 65, 'name' => 'Frames', 'url' => 'frames', 'parent_id' => 4,
        //                 'meta_desc' => "We believe that frames should be equally beautiful just as the picture. We have a wide
        // range of varied frames to make your interior look a little more artistic."
        //             ],
        //             [
        //                 'id' => 66, 'name' => 'Handmade Cards', 'url' => 'cards', 'parent_id' => 4,
        //                 'meta_desc' => "Everything that is handmade has just that extra sense of love. Make moments
        //                  meaningful and personal with cards handcrafted with love."
        //             ],
        //             [
        //                 'id' => 67, 'name' => 'Explosion Box', 'url' => 'explosion-box', 'parent_id' => 4,
        //                 'meta_desc' => "Handmade gifts is a work art. when you send gifts like explosion boxes to someone,
        // you are sending an emotional piece of yourself. There is no better way to tell
        // someone you care."
        //             ],
        //             [
        //                 'id' => 68, 'name' => 'Bookmarks', 'url' => 'bookmarks', 'parent_id' => 4,
        //                 'meta_desc' => "Bookmarks is the type of art and craft that is simple yet fun and Artistic. Make each
        // part of your life personalised and filled with creativity."
        //             ],
        //             [
        //                 'id' => 69, 'name' => 'Mugs', 'url' => 'mugs', 'parent_id' => 4,
        //                 'meta_desc' => "Right from the early morning espressos to herbal tea to iced tea, our mugs and
        // cups are here to improve your drinking experience! Why not make it a little more
        // artistic."
        //             ],
        //             [
        //                 'id' => 70, 'name' => 'Pottery', 'url' => 'pottery', 'parent_id' => 4,
        //                 'meta_desc' => "Pottery is the type of artwork in which clay is formed, dried, and fired, usually with a glaze or
        // finish, into a platter, cup, vessel or decorative item. Pottery items are truly intricate and
        // beautifies the cutlery collection of your home."
        //             ],
        //             [
        //                 'id' => 71, 'name' => 'Trinket Boxes', 'url' => 'trinket-boxes', 'parent_id' => 4,
        //                 'meta_desc' => "Trinket boxes are small boxes to keep your jewellery in and more than just functional, but
        // also decorative and artistic. These boxes are very handy, serves the purpose but at the same
        // time visually pleasing as well."
        //             ],
        //             [
        //                 'id' => 72, 'name' => 'Tissue Boxes', 'url' => 'tissue-boxes', 'parent_id' => 4,
        //                 'meta_desc' => "Tissue boxes have become a must for the dining table and for places that need more hygiene
        // and cleanliness. Why not make it a little artistic and decorative!"
        //             ],
        //             [
        //                 'id' => 73, 'name' => 'Diyas', 'url' => 'diyas', 'parent_id' => 4,
        //                 'meta_desc' => "Diyas often symbolizes goodness and virtue, and lighting them denotes dispelling evil and
        // going into light. They symbolize the victory of good over evil and are often lit on auspicious
        // occasions.."
        //             ]


        //         ];
        $json = Storage::disk('local')->get('data/categories.json');
        $categories = json_decode($json);

        foreach ($categories as $category) {
            $data = Category::create(array(
                'name' => $category->name,
                'url' => $category->url,
                'meta_desc' => $category->meta_desc,

            ));
            foreach ($category->children as $categoryChild) {
                $nestedData = $data->children()->create(array(
                    'name' => $categoryChild->name,
                    'url' => $categoryChild->url,
                    'meta_desc' => $categoryChild->meta_desc,

                ));
                foreach ($categoryChild->children as $categorySubChild) {
                    $nestedData->children()->create(array(
                        'name' => $categorySubChild->name,
                        'url' => $categorySubChild->url,
                        'meta_desc' => $categorySubChild->meta_desc,

                    ));
                }
            }
        }
    }
}

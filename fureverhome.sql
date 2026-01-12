-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2026 at 03:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fureverhome`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pet_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shelter_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected','cancelled','completed') NOT NULL DEFAULT 'pending',
  `reason` text NOT NULL,
  `experience` text DEFAULT NULL,
  `housing_type` varchar(255) NOT NULL,
  `has_other_pets` tinyint(1) NOT NULL DEFAULT 0,
  `other_pets_details` text DEFAULT NULL,
  `has_children` tinyint(1) NOT NULL DEFAULT 0,
  `children_ages` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `references` text DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `living_situation` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adoptions`
--

INSERT INTO `adoptions` (`id`, `pet_id`, `user_id`, `shelter_id`, `status`, `reason`, `experience`, `housing_type`, `has_other_pets`, `other_pets_details`, `has_children`, `children_ages`, `phone`, `address`, `references`, `rejection_reason`, `reviewed_at`, `completed_at`, `living_situation`, `notes`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 'approved', 'Saya ingin mengadopsi Max karena anjing saya yang satu lagi kesepian dan butuh teman sejati selama saya pergi keluar.', 'Saya punya 1 anjing besar Golden', 'house', 1, '1 Anjing Golden', 0, NULL, '+62 123 123 123 123', 'Jakarta Barat', NULL, NULL, '2026-01-12 07:08:37', NULL, NULL, NULL, NULL, '2026-01-12 07:08:16', '2026-01-12 07:08:37'),
(2, 10, 3, 2, 'rejected', 'Saya iseng-iseng saja boleh tidak saya pelihara burung ini?', '-', 'apartment', 0, NULL, 0, NULL, '+62 123 123 123 123', 'Jakarta Timur', NULL, 'Kurang komitmen, maaf kami belum bisa memenuhi permintaan anda', '2026-01-12 07:17:45', NULL, NULL, NULL, NULL, '2026-01-12 07:11:12', '2026-01-12 07:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `author_id`, `category_id`, `title`, `content`, `featured_image`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 8, 'Complete Guide to Adopting Your First Dog', 'Adopting a dog is a life-changing decision that brings immense joy and responsibility. Before bringing your new furry friend home, it\'s essential to prepare your living space, gather necessary supplies, and understand the commitment involved.\n\nFirst, ensure your home is dog-proofed. Remove any toxic plants, secure loose wires, and create a safe space for your new pet. You\'ll need basic supplies including food and water bowls, a comfortable bed, collar and leash, ID tags, and appropriate food.\n\nConsider your lifestyle when choosing a dog. Active individuals might prefer energetic breeds, while those with a calmer lifestyle might opt for more relaxed companions. Remember that all dogs need regular exercise, training, and veterinary care.\n\nThe first few weeks are crucial for bonding. Establish a routine for feeding, walks, and playtime. Be patient as your dog adjusts to their new environment. Positive reinforcement training works best for building trust and teaching good behavior.\n\nRegular veterinary check-ups are essential. Ensure your dog is up-to-date on vaccinations, spayed or neutered, and receives preventive care for parasites. A healthy dog is a happy dog!\n\nRemember, adopting a dog is a long-term commitment that can last 10-15 years or more. With proper care, training, and lots of love, your adopted dog will become a cherished family member.', 'articles/article-1-1768226679.jpg', 345, '2026-01-12 07:04:39', '2026-01-12 07:04:39', NULL),
(2, 1, 9, 'Understanding Cat Behavior: A Beginner\'s Guide', 'Cats are fascinating creatures with unique behaviors that often puzzle new cat owners. Understanding your cat\'s body language and vocalizations is key to building a strong bond.\n\nTail position is one of the most telling signs of a cat\'s mood. A tail held high indicates confidence and happiness, while a puffed-up tail signals fear or aggression. A slowly swishing tail might mean your cat is focused or slightly annoyed.\n\nPurring usually indicates contentment, but cats also purr when stressed or in pain. Pay attention to the context. Meowing is primarily used to communicate with humans, not other cats. Each cat develops their own vocabulary with their owner.\n\nCats are naturally curious and need mental stimulation. Provide scratching posts, climbing structures, and interactive toys. Window perches allow them to watch the outside world, which many cats find entertaining.\n\nLitter box issues often stem from stress, medical problems, or dissatisfaction with the box\'s cleanliness or location. Keep the litter box clean and in a quiet, accessible area.\n\nRespect your cat\'s need for personal space. Unlike dogs, cats often prefer to initiate interaction. Let them come to you, and you\'ll build trust over time. With patience and understanding, you\'ll develop a deep bond with your feline friend.', 'articles/article-2-1768226680.jpg', 387, '2026-01-12 07:04:40', '2026-01-12 07:04:40', NULL),
(3, 1, 11, 'Essential Vaccinations for Your Pet', 'Vaccinations are crucial for protecting your pet from serious diseases. Understanding which vaccines your pet needs and when they need them is an important part of responsible pet ownership.\n\nFor dogs, core vaccines include rabies, distemper, parvovirus, and adenovirus. Puppies typically receive their first vaccines at 6-8 weeks of age, with boosters every 3-4 weeks until they\'re 16 weeks old. Adult dogs need regular boosters, usually every 1-3 years depending on the vaccine.\n\nCats require vaccines for rabies, feline distemper (panleukopenia), feline herpesvirus, and calicivirus. Kittens follow a similar schedule to puppies, starting at 6-8 weeks with boosters until 16 weeks of age.\n\nNon-core vaccines are recommended based on your pet\'s lifestyle and risk factors. For dogs, these might include Bordetella (kennel cough), Lyme disease, and leptospirosis. For cats, feline leukemia vaccine is important for outdoor cats or those living with infected cats.\n\nVaccine reactions are rare but can occur. Watch for signs like swelling at the injection site, fever, or lethargy. Contact your veterinarian if you notice any concerning symptoms.\n\nKeep a record of your pet\'s vaccinations. Many boarding facilities, groomers, and dog parks require proof of current vaccinations. Regular veterinary check-ups ensure your pet stays protected throughout their life.', 'articles/article-3-1768226681.jpg', 315, '2026-01-12 07:04:41', '2026-01-12 07:04:41', NULL),
(4, 1, 11, 'Creating a Pet-Friendly Home Environment', 'Making your home safe and comfortable for your pet is essential for their well-being and your peace of mind. A pet-friendly home considers both safety and enrichment.\n\nStart by identifying potential hazards. Secure electrical cords, remove toxic plants, and store cleaning supplies and medications out of reach. Common household items like chocolate, grapes, and certain houseplants can be toxic to pets.\n\nCreate designated spaces for your pet. A comfortable bed in a quiet corner provides a safe retreat. For cats, vertical space is important – consider cat trees or wall-mounted shelves. Dogs appreciate having their own space too, whether it\'s a crate or a cozy corner.\n\nPet-proof your furniture and floors. Washable slipcovers protect furniture from fur and accidents. Choose flooring that\'s easy to clean and provides good traction. Area rugs can help on slippery surfaces.\n\nProvide appropriate toys and enrichment. Rotate toys to keep them interesting. Puzzle feeders and interactive toys provide mental stimulation. For cats, scratching posts are essential to protect your furniture.\n\nEstablish feeding and bathroom areas. Keep food and water bowls in a consistent location. For cats, place litter boxes in quiet, accessible areas – one per cat plus one extra is the general rule.\n\nConsider your pet\'s needs as they age. Older pets may need ramps or steps to access favorite spots. Orthopedic beds can help with joint pain. A pet-friendly home adapts to your companion\'s changing needs throughout their life.', 'articles/article-4-1768226681.jpg', 326, '2026-01-12 07:04:41', '2026-01-12 07:04:41', NULL),
(5, 1, 11, 'The Benefits of Adopting Senior Pets', 'Senior pets often get overlooked in shelters, but they make wonderful companions. Adopting an older pet comes with unique advantages that many people don\'t consider.\n\nSenior pets typically have calmer temperaments. They\'re past the energetic puppy or kitten stage and are often content with moderate exercise and lots of cuddles. This makes them ideal for people with less active lifestyles or those who work long hours.\n\nWhat you see is what you get with senior pets. Their personality is fully developed, so there are no surprises about their adult size or temperament. This makes it easier to find a pet that matches your lifestyle and living situation.\n\nMany senior pets are already trained. They often know basic commands, are house-trained, and have experience living in a home. This means less time spent on training and more time enjoying your new companion.\n\nSenior pets are grateful. Many seem to understand they\'ve been given a second chance and form deep bonds with their adopters. The love and loyalty of a senior pet is truly special.\n\nWhile senior pets may have health considerations, many are healthy and active. Regular veterinary care can help manage any age-related issues. The years you have together, though perhaps fewer than with a younger pet, are filled with love and companionship.\n\nAdopting a senior pet is a compassionate choice that saves a life. You\'re giving a deserving animal a comfortable, loving home for their golden years. The bond you\'ll form is incredibly rewarding.', 'articles/article-5-1768226682.jpg', 123, '2026-01-12 07:04:42', '2026-01-12 07:04:42', NULL),
(6, 1, 8, 'Nutrition Guide: Feeding Your Pet Right', 'Proper nutrition is fundamental to your pet\'s health and longevity. Understanding your pet\'s nutritional needs helps you make informed decisions about their diet.\n\nPets need a balanced diet with the right proportions of protein, fats, carbohydrates, vitamins, and minerals. The specific requirements vary by species, age, size, and activity level. Puppies and kittens need more calories and nutrients for growth, while senior pets may need fewer calories but more joint support.\n\nChoose high-quality pet food from reputable brands. Look for foods where meat is the first ingredient. Avoid foods with excessive fillers, artificial colors, or preservatives. Read labels carefully and consult your veterinarian about the best choice for your pet.\n\nPortion control is crucial. Obesity is a growing problem in pets and can lead to serious health issues. Follow feeding guidelines on pet food packages, but adjust based on your pet\'s individual needs and activity level. Regular weigh-ins help monitor your pet\'s condition.\n\nTreats should make up no more than 10% of your pet\'s daily calories. Choose healthy options like small pieces of cooked chicken or vegetables (for dogs). Avoid giving human food that can be toxic to pets.\n\nFresh water should always be available. Change water daily and clean bowls regularly to prevent bacterial growth.\n\nSpecial diets may be necessary for pets with health conditions. Your veterinarian can recommend prescription diets for issues like kidney disease, allergies, or digestive problems. Never change your pet\'s diet suddenly – transition gradually over 7-10 days to avoid digestive upset.', 'articles/article-6-1768226683.jpg', 88, '2026-01-12 07:04:43', '2026-01-12 07:04:43', NULL),
(7, 1, 9, 'Training Tips for New Pet Owners', 'Training is essential for a harmonious relationship with your pet. Whether you\'ve adopted a puppy, kitten, or adult pet, consistent training creates a well-behaved companion.\n\nStart with basic commands. For dogs, focus on sit, stay, come, and down. Use positive reinforcement – reward desired behaviors with treats, praise, or play. Never use punishment or harsh corrections, as these can damage trust and create fear.\n\nConsistency is key. Everyone in the household should use the same commands and rules. If one person allows the dog on the couch while another doesn\'t, your pet will be confused.\n\nKeep training sessions short and fun. Five to ten minutes several times a day is more effective than one long session. End on a positive note to keep your pet engaged and eager for the next session.\n\nSocialization is crucial, especially for puppies and kittens. Expose them to different people, animals, sounds, and environments in a positive way. This helps prevent fear and aggression later in life.\n\nFor cats, training focuses on litter box use, scratching appropriate surfaces, and interactive play. Use treats and praise to reinforce good behavior. Provide alternatives to unwanted behaviors – if your cat scratches furniture, offer attractive scratching posts.\n\nAddress problem behaviors promptly. Barking, jumping, or destructive behavior often stems from boredom, anxiety, or lack of exercise. Increase physical activity and mental stimulation. If problems persist, consult a professional trainer or behaviorist.\n\nPatience is essential. Every pet learns at their own pace. Celebrate small victories and remember that building a strong bond takes time and consistent effort.', 'articles/article-7-1768226684.jpg', 444, '2026-01-12 07:04:44', '2026-01-12 07:04:44', NULL),
(8, 1, 10, 'Preparing for Pet Emergencies', 'Being prepared for pet emergencies can save your companion\'s life. Every pet owner should know basic first aid and have an emergency plan.\n\nCreate a pet first aid kit. Include gauze, adhesive tape, scissors, tweezers, a digital thermometer, hydrogen peroxide (to induce vomiting if instructed by a vet), and a pet first aid manual. Keep your veterinarian\'s contact information and the nearest emergency vet clinic\'s number readily available.\n\nKnow the signs of common emergencies. Difficulty breathing, severe bleeding, seizures, inability to urinate, suspected poisoning, and trauma from accidents require immediate veterinary attention. Don\'t wait to see if symptoms improve.\n\nLearn basic first aid techniques. Know how to perform CPR on your pet, apply pressure to stop bleeding, and safely transport an injured animal. Many organizations offer pet first aid courses.\n\nKeep your pet\'s medical records accessible. In an emergency, having vaccination records, medication lists, and medical history can help veterinarians provide appropriate care quickly.\n\nHave a disaster preparedness plan. In case of natural disasters or evacuation, have a pet emergency kit ready with food, water, medications, medical records, and comfort items. Know which hotels or shelters accept pets.\n\nConsider pet insurance. While not necessary for everyone, it can help cover unexpected emergency veterinary costs, which can be substantial.\n\nStay calm during emergencies. Your pet can sense your anxiety. Speak in a soothing voice and handle them gently. Quick, calm action and immediate veterinary care give your pet the best chance of recovery.', 'articles/article-8-1768226685.jpg', 198, '2026-01-12 07:04:45', '2026-01-12 07:04:45', NULL),
(9, 1, 11, 'Grooming Tips for a Healthy Pet', 'Regular grooming is essential for your pet\'s health and well-being. It\'s not just about keeping them looking good – grooming helps prevent health issues and strengthens your bond.\n\nFor dogs, brushing frequency depends on coat type. Long-haired breeds need daily brushing to prevent mats and tangles, while short-haired dogs can be brushed weekly. Regular brushing removes loose fur, distributes natural oils, and allows you to check for skin issues or parasites.\n\nBathing should be done as needed, typically every 4-8 weeks for dogs. Over-bathing can strip natural oils and cause dry skin. Use pet-specific shampoos – human products can irritate their skin. Always rinse thoroughly to remove all soap residue.\n\nNail trimming is crucial but often overlooked. Long nails can cause discomfort and affect your pet\'s gait. Trim nails every 3-4 weeks, or when you hear them clicking on the floor. If you\'re nervous about cutting too short, ask your vet or groomer to demonstrate.\n\nDental care is vital for overall health. Brush your pet\'s teeth regularly with pet-safe toothpaste. Dental disease can lead to serious health problems affecting the heart, liver, and kidneys. Provide dental chews and toys to help keep teeth clean.\n\nEar cleaning prevents infections, especially in dogs with floppy ears. Check ears weekly for redness, odor, or discharge. Clean with a vet-approved solution, never inserting anything deep into the ear canal.\n\nFor cats, regular brushing reduces hairballs and keeps their coat healthy. Most cats are excellent self-groomers, but they still benefit from your help, especially long-haired breeds.\n\nMake grooming a positive experience with treats and praise. Start young to help pets become comfortable with handling. If grooming becomes stressful or you\'re unsure about any aspect, professional groomers can help maintain your pet\'s coat and health.', 'articles/article-9-1768226685.jpg', 414, '2026-01-12 07:04:45', '2026-01-12 07:04:45', NULL),
(10, 1, 8, 'Understanding Dog Body Language', 'Dogs communicate primarily through body language. Learning to read these signals helps you understand your dog\'s emotions and prevents misunderstandings.\n\nTail wagging doesn\'t always mean happiness. The position and speed matter. A high, stiff wag can indicate alertness or potential aggression. A low, slow wag suggests uncertainty. A relaxed, mid-level wag with loose body movements typically shows friendliness.\n\nEar position reveals much about mood. Forward-facing ears show interest and attention. Ears pulled back against the head indicate fear or submission. Relaxed ears in their natural position suggest contentment.\n\nEye contact has different meanings. Soft eyes with relaxed facial muscles show trust and affection. Hard stares with tense body posture can be a challenge or threat. If a dog looks away or shows the whites of their eyes (whale eye), they\'re likely stressed or uncomfortable.\n\nBody posture tells the whole story. A play bow – front end down, rear up – is an invitation to play. A dog making themselves smaller, with lowered body and tucked tail, is showing submission or fear. Stiff, upright posture with raised hackles indicates arousal, which could be excitement or aggression.\n\nMouth and facial expressions are important too. A relaxed, slightly open mouth is normal. Lip licking, yawning, or showing teeth can indicate stress or discomfort. A tense, closed mouth often accompanies anxiety.\n\nPaw lifting can mean uncertainty or anticipation. Some dogs lift a paw when pointing at something interesting, while others do it when anxious.\n\nUnderstanding these signals helps you respond appropriately to your dog\'s needs. If you notice stress signals, remove your dog from the situation. Recognizing play signals helps you engage in fun activities. Reading body language strengthens your relationship and keeps everyone safe.', 'articles/article-10-1768226686.jpg', 383, '2026-01-12 07:04:46', '2026-01-12 07:04:46', NULL),
(11, 1, 9, 'Indoor Enrichment Activities for Cats', 'Indoor cats need mental and physical stimulation to stay healthy and happy. Enrichment prevents boredom, reduces behavioral problems, and keeps your cat engaged.\n\nInteractive play is essential. Use wand toys to mimic prey movements – birds, mice, or insects. Play sessions should be 10-15 minutes, twice daily. Let your cat \'catch\' the toy occasionally to satisfy their hunting instinct. Rotate toys to maintain interest.\n\nPuzzle feeders make mealtime engaging. Instead of a bowl, use food puzzles that require your cat to work for their meals. This provides mental stimulation and slows down fast eaters. Start with easy puzzles and gradually increase difficulty.\n\nVertical space is crucial for cats. Install cat trees, shelves, or window perches. Cats feel secure when they can observe from high vantage points. Create pathways along walls using shelves, allowing your cat to navigate the room without touching the floor.\n\nWindow watching provides endless entertainment. Set up bird feeders outside windows to create \'cat TV.\' Secure window perches give your cat a comfortable viewing spot. Some cats enjoy videos made specifically for feline entertainment.\n\nScent enrichment engages their powerful sense of smell. Offer cat-safe herbs like catnip, silvervine, or cat grass. Hide treats around the house for scavenger hunts. Rotate toys through a closed container with catnip to refresh their appeal.\n\nScratch-friendly surfaces are necessary. Provide various scratching posts – vertical, horizontal, and angled. Use different materials like sisal, cardboard, and carpet. Place scratchers near sleeping areas and high-traffic zones.\n\nHiding spots make cats feel secure. Provide boxes, tunnels, or cat tents. Cats need places to retreat when they want privacy or feel overwhelmed.\n\nTraining sessions offer mental stimulation. Cats can learn tricks, come when called, and even walk on leashes. Use positive reinforcement with treats and praise. Short, fun sessions work best.\n\nConsider a companion if your cat seems lonely. Some cats thrive with a feline friend, though introductions must be gradual and careful.', 'articles/article-11-1768226687.jpg', 408, '2026-01-12 07:04:47', '2026-01-12 07:04:47', NULL),
(12, 1, 11, 'Choosing the Right Pet for Your Lifestyle', 'Selecting a pet is a major decision that affects your life for years to come. The right match depends on your lifestyle, living situation, and personal preferences.\n\nConsider your activity level. High-energy dogs like Border Collies or Australian Shepherds need extensive daily exercise and mental stimulation. If you\'re active and outdoorsy, these breeds might be perfect. Prefer quiet evenings? Consider lower-energy breeds like Basset Hounds or senior pets who need less activity.\n\nLiving space matters. Large dogs can adapt to apartments with sufficient exercise, but small spaces work better for smaller breeds or cats. Consider outdoor access – do you have a yard, or will you need to walk your dog multiple times daily? Cats generally adapt well to various living situations.\n\nTime commitment varies by pet. Dogs require significant daily attention – feeding, walking, training, and companionship. Cats are more independent but still need daily interaction, play, and care. Small pets like rabbits or guinea pigs need daily care and regular habitat cleaning. Consider your work schedule and social life.\n\nFinancial responsibility is significant. Budget for food, routine veterinary care, vaccinations, preventive medications, grooming, and emergency medical expenses. Pet insurance can help with unexpected costs. Some breeds have specific health issues requiring extra care.\n\nAllergies affect pet choice. Some people tolerate certain breeds better than others. Spend time with the type of pet you\'re considering before committing. No pet is truly hypoallergenic, but some produce fewer allergens.\n\nFamily dynamics matter. Young children do well with patient, gentle pets. Consider everyone\'s comfort level and ability to help with pet care. Teach children appropriate interaction with animals.\n\nFuture plans should be considered. Pets live many years – will your lifestyle accommodate them long-term? Consider career changes, potential moves, or family planning.\n\nAdoption is wonderful. Shelters have pets of all ages, sizes, and temperaments. Adult pets often come trained and their personalities are known. Senior pets make excellent companions and deserve loving homes.\n\nResearch breeds or species thoroughly. Understand typical behaviors, needs, and potential challenges. Talk to current owners, veterinarians, and shelter staff. The right pet enriches your life immeasurably – take time to choose wisely.', 'articles/article-12-1768226687.jpg', 255, '2026-01-12 07:04:47', '2026-01-12 07:04:47', NULL),
(13, 1, 8, 'Common Health Issues in Dogs and Prevention', 'Understanding common canine health issues helps you recognize problems early and take preventive measures. Regular veterinary care is essential, but awareness empowers you to be proactive.\n\nObesity affects over half of dogs. Excess weight leads to diabetes, joint problems, heart disease, and shortened lifespan. Prevent obesity through portion control, measured meals, limited treats, and regular exercise. If your dog is overweight, consult your vet for a safe weight loss plan.\n\nDental disease is extremely common. By age three, most dogs show signs of periodontal disease. Bacteria from infected gums can spread to vital organs. Prevent dental issues with regular brushing, dental chews, and professional cleanings. Watch for bad breath, difficulty eating, or swollen gums.\n\nEar infections plague dogs with floppy ears or those who swim frequently. Signs include head shaking, scratching, odor, or discharge. Keep ears clean and dry. After swimming or bathing, dry ears thoroughly. Regular checks catch infections early.\n\nSkin allergies cause intense itching and discomfort. Environmental allergens, food sensitivities, or flea bites trigger reactions. Symptoms include scratching, licking, red skin, or hair loss. Identify and avoid triggers when possible. Your vet can recommend treatments for relief.\n\nArthritis affects many older dogs and some younger ones with joint issues. Signs include stiffness, difficulty rising, reluctance to jump or climb stairs, and decreased activity. Maintain healthy weight to reduce joint stress. Supplements, medications, and physical therapy can help manage pain.\n\nHeartworm is preventable but potentially fatal. Transmitted by mosquitoes, heartworms damage the heart and lungs. Prevention is simple – monthly medication year-round. Annual testing ensures your dog remains heartworm-free.\n\nParasites like fleas, ticks, and intestinal worms cause various problems. Fleas trigger allergies and transmit diseases. Ticks carry Lyme disease and other illnesses. Intestinal parasites affect digestion and overall health. Use preventive medications and maintain good hygiene.\n\nKennel cough spreads easily in social settings. This respiratory infection causes persistent coughing. Vaccination helps prevent it, especially important for dogs who interact with others.\n\nRegular veterinary check-ups catch problems early. Annual exams for young dogs, twice yearly for seniors. Don\'t wait for obvious illness – preventive care is key to long, healthy life.', 'articles/article-13-1768226689.jpg', 160, '2026-01-12 07:04:49', '2026-01-12 07:18:55', NULL),
(14, 1, 10, 'Caring for Exotic Pets: Birds, Rabbits, and Small Animals', 'Exotic pets have unique needs that differ significantly from cats and dogs. Understanding these requirements ensures your small companion thrives.\r\n\r\nBirds are intelligent, social creatures requiring substantial care. They need spacious cages allowing full wing extension and flight. Provide varied perches of different diameters and textures for foot health. Mental stimulation is crucial – offer toys, foraging opportunities, and daily out-of-cage time in a safe, supervised area. Birds are messy and noisy, requiring daily cage cleaning. Diet varies by species but typically includes pellets, fresh vegetables, fruits, and limited seeds. Avoid toxic foods like avocado, chocolate, and caffeine. Birds bond strongly with owners and need daily interaction. Many live 20+ years, requiring long-term commitment.\r\n\r\nRabbits are not low-maintenance starter pets. They need large living spaces – minimum 12 square feet, plus exercise time. House rabbits should be litter trained and have bunny-proofed areas to explore. Diet consists mainly of hay (80%), with fresh vegetables and limited pellets. Avoid feeding too many fruits or treats. Rabbits need hiding spots and elevated platforms. They\'re social and often do better in bonded pairs. Spaying/neutering reduces aggression and health issues. Rabbits require regular grooming, especially long-haired breeds. Dental care is critical – teeth grow continuously and need wearing down through proper diet. Veterinary care from exotic pet specialists is essential. Rabbits can live 8-12 years with proper care.\r\n\r\nGuinea pigs are social and should be kept in same-sex pairs or groups. They need large cages with solid flooring, not wire. Provide hiding spots and enrichment. Diet requires unlimited hay, fresh vegetables daily, and vitamin C supplementation – guinea pigs can\'t produce their own. They\'re vocal and interactive, making various sounds. Regular nail trims and occasional baths keep them healthy. Guinea pigs live 5-7 years.\r\n\r\nHamsters are nocturnal and solitary (except dwarf varieties). They need appropriate-sized cages with deep bedding for burrowing, exercise wheels, and toys. Avoid cedar or pine shavings. Diet includes pellets, small amounts of fresh foods, and occasional treats. Handle gently and regularly for socialization. Hamsters live 2-3 years.\r\n\r\nAll exotic pets need specialized veterinary care. Find a vet experienced with your pet\'s species before emergencies arise. Research thoroughly before acquiring any exotic pet – their needs are complex and specific.', 'articles/yMJl84pH1WBJCSY95vp51IV3iY9v7z3TKwagHtJx.png', 461, '2026-01-12 07:04:49', '2026-01-12 07:20:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'pet',
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `type`, `icon`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dogs', 'dogs', 'Man\'s best friend - loyal, loving companions', 'pet', '🐶', '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(2, NULL, 'Cats', 'cats', 'Independent and affectionate feline friends', 'pet', '🐱', '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(3, NULL, 'Other', 'other', 'Other unique and special pets', 'pet', '🐰', '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(4, 3, 'Birds', 'birds', 'Colorful and cheerful feathered companions', 'pet', '🐦', '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(5, 3, 'Rabbits', 'rabbits', 'Gentle and social hopping friends', 'pet', '🐰', '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(6, 3, 'Small Pets', 'small-pets', 'Hamsters, guinea pigs, and other small pets', 'pet', '🐹', '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(7, 3, 'Reptiles & Aquatics', 'reptiles-aquatics', 'Reptiles, amphibians, and fish', 'pet', '🐍', '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(8, 1, 'Dogs', 'dogs-articles', 'Articles about dog care and training', 'article', '🐶', '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(9, 2, 'Cats', 'cats-articles', 'Articles about cat care and behavior', 'article', '🐱', '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(10, 3, 'Other animal', 'other-animal-articles', 'Articles about other pets and animals', 'article', '🐰', '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(11, 1, 'General', 'general-articles', 'General pet care articles', 'article', '📰', '2026-01-12 07:04:38', '2026-01-12 07:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_24_035926_create_shelters_table', 1),
(5, '2025_11_24_035931_create_categories_table', 1),
(6, '2025_11_24_035935_create_pets_table', 1),
(7, '2025_11_24_035940_create_pet_images_table', 1),
(8, '2025_11_24_035944_create_adoptions_table', 1),
(9, '2025_11_24_035949_create_sponsorships_table', 1),
(10, '2025_11_24_035954_create_platform_donations_table', 1),
(11, '2025_11_24_040004_create_articles_table', 1),
(12, '2026_01_12_065440_add_type_to_categories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shelter_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `age_years` int(11) NOT NULL DEFAULT 0,
  `age_months` int(11) NOT NULL DEFAULT 0,
  `gender` enum('male','female') NOT NULL,
  `size` enum('small','medium','large') NOT NULL,
  `description` text NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `health_status` text DEFAULT NULL,
  `vaccination_status` varchar(255) DEFAULT NULL,
  `is_neutered` tinyint(1) NOT NULL DEFAULT 0,
  `is_house_trained` tinyint(1) NOT NULL DEFAULT 0,
  `good_with_kids` tinyint(1) NOT NULL DEFAULT 0,
  `good_with_pets` tinyint(1) NOT NULL DEFAULT 0,
  `adoption_fee` decimal(10,2) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `adopted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `shelter_id`, `category_id`, `name`, `age_years`, `age_months`, `gender`, `size`, `description`, `breed`, `color`, `medical_history`, `health_status`, `vaccination_status`, `is_neutered`, `is_house_trained`, `good_with_kids`, `good_with_pets`, `adoption_fee`, `is_available`, `image`, `adopted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Max', 2, 6, 'male', 'large', 'Max is a friendly and energetic Golden Retriever who loves to play fetch and go for long walks. He is great with children and other dogs. Max is fully trained and knows basic commands. He would be perfect for an active family with a backyard.', 'Golden Retriever', 'Golden', NULL, 'Excellent', 'Up to date - Rabies, DHPP, Bordetella', 1, 1, 1, 1, 500000.00, 0, 'https://picsum.photos/seed/dog-max/800/600', NULL, '2026-01-12 07:04:38', '2026-01-12 07:08:37'),
(2, 1, 1, 'Luna', 1, 3, 'female', 'medium', 'Luna is a sweet and playful Beagle mix puppy. She loves to cuddle and is very affectionate. Luna is still learning her manners but is eager to please. She would thrive in a home where someone can spend time training her.', 'Beagle Mix', 'Tricolor', NULL, 'Good', 'Up to date', 1, 0, 1, 1, 400000.00, 1, 'https://picsum.photos/seed/dog-luna/800/600', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(3, 2, 1, 'Rocky', 5, 0, 'male', 'large', 'Rocky is a loyal and protective German Shepherd. He is well-trained and very obedient. Rocky needs an experienced owner who can provide structure and exercise. He is great as a guard dog and family protector.', 'German Shepherd', 'Black and Tan', NULL, 'Excellent', 'Current', 1, 1, 0, 0, 600000.00, 0, 'https://picsum.photos/seed/dog-rocky/800/600', NULL, '2026-01-12 07:04:38', '2026-01-12 07:18:34'),
(4, 2, 1, 'Bella', 0, 8, 'female', 'small', 'Bella is a tiny bundle of energy! This Chihuahua puppy loves attention and being the center of your world. She is perfect for apartment living and would make a great companion for someone looking for a small, portable friend.', 'Chihuahua', 'Brown', NULL, 'Good', 'In progress', 0, 0, 0, 1, 350000.00, 1, 'https://picsum.photos/seed/dog-bella/800/600', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(5, 1, 2, 'Whiskers', 3, 0, 'male', 'medium', 'Whiskers is a laid-back orange tabby who loves nothing more than lounging in sunny spots and getting head scratches. He is independent but affectionate on his own terms. Perfect for someone looking for a calm companion.', 'Domestic Shorthair', 'Orange Tabby', NULL, 'Excellent', 'Up to date - FVRCP, Rabies', 1, 1, 1, 0, 300000.00, 1, 'https://picsum.photos/seed/cat-whiskers/800/600', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(6, 1, 2, 'Shadow', 1, 0, 'female', 'small', 'Shadow is a playful black cat with bright green eyes. She loves chasing toys and climbing cat trees. Shadow is very social and gets along well with other cats. She would do best in a home with another feline friend.', 'Domestic Shorthair', 'Black', NULL, 'Good', 'Current', 1, 1, 1, 1, 250000.00, 1, 'https://picsum.photos/seed/cat-shadow/800/600', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(7, 2, 2, 'Simba', 0, 4, 'male', 'small', 'Simba is an adorable Persian mix kitten with fluffy cream-colored fur. He is curious, playful, and loves to explore. Simba needs regular grooming to keep his coat beautiful. He would be perfect for someone who has time to care for his special needs.', 'Persian Mix', 'Cream', NULL, 'Good', 'In progress', 0, 1, 1, 1, 400000.00, 1, 'https://picsum.photos/seed/cat-simba/800/600', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(8, 2, 2, 'Mittens', 7, 0, 'female', 'medium', 'Mittens is a senior cat looking for a quiet retirement home. She is gentle, calm, and loves being petted. Mittens would be perfect for an older person or anyone looking for a low-maintenance companion. She has a lot of love left to give.', 'Domestic Longhair', 'Grey and White', NULL, 'Good - Senior wellness checked', 'Current', 1, 1, 0, 0, 150000.00, 1, 'https://picsum.photos/seed/cat-mittens/800/600', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(9, 1, 5, 'Cotton', 1, 6, 'female', 'small', 'Cotton is a friendly Holland Lop rabbit with beautiful white fur and floppy ears. She loves fresh vegetables and hopping around in a safe play area. Cotton is litter-trained and would make a great indoor pet.', 'Holland Lop', 'White', NULL, 'Excellent', 'N/A', 1, 1, 1, 0, 200000.00, 1, 'https://picsum.photos/seed/rabbit-cotton/800/600', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(10, 2, 4, 'Tweety', 2, 0, 'male', 'small', 'Tweety is a charming cockatiel who loves to whistle and sing. He is social and enjoys interacting with people. Tweety needs a spacious cage and time outside for exercise. He would be great for someone experienced with birds.', 'Cockatiel', 'Yellow and Grey', NULL, 'Excellent', 'N/A', 0, 0, 1, 0, 300000.00, 1, 'https://picsum.photos/seed/bird-tweety/800/600', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `pet_images`
--

CREATE TABLE `pet_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pet_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `platform_donations`
--

CREATE TABLE `platform_donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'midtrans',
  `payment_status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `donor_name` varchar(255) DEFAULT NULL,
  `donor_email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- --------------------------------------------------------

--
-- Table structure for table `shelters`
--

CREATE TABLE `shelters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shelters`
--

INSERT INTO `shelters` (`id`, `user_id`, `name`, `address`, `phone`, `email`, `description`, `website`, `logo`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 2, 'Happy Paws Shelter', 'Jl. Raya Bogor No. 123, Jakarta Timur, DKI Jakarta 13810', '+62 21 8888 9999', 'info@happypaws.com', 'Happy Paws is a non-profit animal shelter dedicated to rescuing, rehabilitating, and rehoming abandoned and abused animals. We have been serving the Jakarta community since 2015.', 'https://happypaws.com', NULL, 1, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(2, 4, 'Paws & Claws Rescue', 'Jl. Sudirman No. 456, Bandung, Jawa Barat 40123', '+62 22 7777 8888', 'contact@pawsclaws.com', 'A rescue organization focused on finding loving homes for cats and dogs in West Java.', 'https://pawsclaws.com', NULL, 1, '2026-01-12 07:04:38', '2026-01-12 07:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorships`
--

CREATE TABLE `sponsorships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shelter_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'midtrans',
  `payment_status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsorships`
--

INSERT INTO `sponsorships` (`id`, `user_id`, `shelter_id`, `amount`, `payment_method`, `payment_status`, `transaction_id`, `message`, `is_anonymous`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 50000.00, 'midtrans', 'pending', 'SPONSOR-1-1768226940', 'Sehat-sehat Rocky', 0, NULL, '2026-01-12 07:09:00', '2026-01-12 07:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('adopter','shelter','admin') NOT NULL DEFAULT 'adopter',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin FureverHome', 'admin@fureverhome.com', 'admin', NULL, '$2y$12$JWB8YBljk3kc/TkEiERgTOUbKKBWEsBckGlBH.9PcS8uEE2atOymC', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(2, 'Happy Paws Shelter', 'shelter@fureverhome.com', 'shelter', NULL, '$2y$12$uJzsHy2UspFUdoUprWv8I.o.clXenPKFSSKum65U/kvDHDUjjg53.', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(3, 'John Adopter', 'adopter@fureverhome.com', 'adopter', NULL, '$2y$12$L6VqmaX8QeJq32mFlPVMYOsI4n5MEY3bEi3bI/aHYEoEyIXt/xZDC', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38'),
(4, 'Paws & Claws Rescue', 'shelter2@fureverhome.com', 'shelter', NULL, '$2y$12$42XTVEcEun9d8c2yXrxhHuQg7ZdrR3c7coO.4cYKz4zZkxvl.fiPS', NULL, '2026-01-12 07:04:38', '2026-01-12 07:04:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adoptions_pet_id_foreign` (`pet_id`),
  ADD KEY `adoptions_user_id_foreign` (`user_id`),
  ADD KEY `adoptions_shelter_id_foreign` (`shelter_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_author_id_foreign` (`author_id`),
  ADD KEY `articles_category_id_foreign` (`category_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_type_index` (`type`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pets_shelter_id_foreign` (`shelter_id`),
  ADD KEY `pets_category_id_foreign` (`category_id`);

--
-- Indexes for table `pet_images`
--
ALTER TABLE `pet_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_images_pet_id_foreign` (`pet_id`);

--
-- Indexes for table `platform_donations`
--
ALTER TABLE `platform_donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `platform_donations_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shelters`
--
ALTER TABLE `shelters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shelters_user_id_foreign` (`user_id`);

--
-- Indexes for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sponsorships_user_id_foreign` (`user_id`),
  ADD KEY `sponsorships_shelter_id_foreign` (`shelter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pet_images`
--
ALTER TABLE `pet_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platform_donations`
--
ALTER TABLE `platform_donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shelters`
--
ALTER TABLE `shelters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sponsorships`
--
ALTER TABLE `sponsorships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_pet_id_foreign` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoptions_shelter_id_foreign` FOREIGN KEY (`shelter_id`) REFERENCES `shelters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `pets_shelter_id_foreign` FOREIGN KEY (`shelter_id`) REFERENCES `shelters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pet_images`
--
ALTER TABLE `pet_images`
  ADD CONSTRAINT `pet_images_pet_id_foreign` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `platform_donations`
--
ALTER TABLE `platform_donations`
  ADD CONSTRAINT `platform_donations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `shelters`
--
ALTER TABLE `shelters`
  ADD CONSTRAINT `shelters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD CONSTRAINT `sponsorships_shelter_id_foreign` FOREIGN KEY (`shelter_id`) REFERENCES `shelters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sponsorships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

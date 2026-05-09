TRUNCATE TABLE tasks;

INSERT INTO `tasks` (`task_name`, `description`, `priority`, `deadline`, `status`, `created_at`, `updated_at`) VALUES
('Review Math notes', 'Go over algebra and geometry lessons from today', 'Urgent and Important', '2026-05-10', 'todo', NOW(), NOW()),
('Submit English essay', '500-word essay about your summer vacation', 'Urgent and Important', '2026-05-11', 'todo', NOW(), NOW()),
('Buy school supplies', 'Notebooks, pens, pencils, and erasers', 'Urgent but Not Important', '2026-05-12', 'todo', NOW(), NOW()),
('Charge laptop', 'Make sure laptop is fully charged before online class', 'Urgent but Not Important', '2026-05-09', 'todo', NOW(), NOW()),
('Prepare lunch for tomorrow', 'Pack sandwich, fruits, and water bottle', 'Important but Not Urgent', '2026-05-10', 'todo', NOW(), NOW()),
('Call best friend', 'Catch up with best friend from elementary school', 'Not Urgent or Important', '2026-05-14', 'todo', NOW(), NOW()),
('Organize study desk', 'Clean and arrange books, notes, and stationery', 'Not Urgent or Important', '2026-05-13', 'todo', NOW(), NOW()),
('Practice public speaking', 'Record yourself delivering a 2-minute speech', 'Important but Not Urgent', '2026-05-15', 'in_progress', NOW(), NOW()),
('Finish reading Chapter 3', 'Read pages 45-60 of History textbook', 'Urgent and Important', '2026-05-10', 'in_progress', NOW(), NOW()),
('Review for Science quiz', 'Study parts of a cell and their functions', 'Urgent and Important', '2026-05-11', 'in_progress', NOW(), NOW()),
('Answer modules', 'Complete 5 modules in Science and Math', 'Urgent and Important', '2026-05-12', 'completed', NOW(), NOW()),
('Attend online class', 'Join Zoom meeting for Filipino subject at 9 AM', 'Urgent and Important', '2026-05-09', 'completed', NOW(), NOW()),
('Do household chores', 'Wash dishes and sweep the floor', 'Important but Not Urgent', '2026-05-10', 'completed', NOW(), NOW()),
('Submit group project', 'PowerPoint presentation about Philippine heroes', 'Urgent and Important', '2026-05-14', 'submitted', NOW(), NOW()),
('Pay school fees', 'Monthly tuition installment payment', 'Urgent and Important', '2026-05-16', 'submitted', NOW(), NOW()),
('Register for webinar', 'Sign up for career guidance seminar', 'Important but Not Urgent', '2026-05-17', 'submitted', NOW(), NOW()),
('Create flashcards', 'Make 20 flashcards for Vocabulary words', 'Important but Not Urgent', '2026-05-13', 'todo', NOW(), NOW()),
('Prepare uniform', 'Iron and arrange school uniform for tomorrow', 'Urgent but Not Important', '2026-05-10', 'todo', NOW(), NOW()),
('Download school materials', 'Save PDF files from Google Classroom', 'Urgent but Not Important', '2026-05-09', 'in_progress', NOW(), NOW()),
('Exercise for 15 minutes', 'Stretching and light cardio to stay healthy', 'Important but Not Urgent', '2026-05-11', 'todo', NOW(), NOW());

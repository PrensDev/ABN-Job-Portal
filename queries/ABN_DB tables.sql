-- CREATE ABN_DB DATABASE
CREATE DATABASE [ABN_DB]

-- USE ABN_DB
USE [ABN_DB]
GO

DROP TABLE JobPosts

--------------------------------------------------------

-- UserAccounts Table
CREATE TABLE [UserAccounts] (
	[userID] 
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_userID@UserAccounts PRIMARY KEY
	,
	[email]
		VARCHAR(450) NOT NULL
		CONSTRAINT UQ_email@UserAccounts UNIQUE
	,
	[password]
		VARCHAR(MAX) NOT NULL
	,
	[userType]
		VARCHAR(MAX) NOT NULL
		CONSTRAINT CK_userType@UserAccounts
			CHECK (userType IN ('Job Seeker', 'Employer'))
	,
	[accountFlag]
		BINARY NOT NULL DEFAULT 1
)


-- JobSeekers Table
CREATE TABLE [JobSeekers] (
	[jobseekerID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_jobseekerID@JobSeekers PRIMARY KEY
	,
	[firstName]
		VARCHAR(MAX) NOT NULL
	,
	[middleName]
		VARCHAR(MAX)
	,
	[lastName]
		VARCHAR(MAX) NOT NULL
	,
	[birthDate]
		DATE NOT NULL
	,
	[gender]
		VARCHAR(MAX) NOT NULL
		CONSTRAINT CK_gender@JobSeekers
			CHECK ([gender] IN (
				'Male', 
				'Female',
				'LGBTQA++',
				'Prefer not to say'
			))
	,
	[street]
		VARCHAR(MAX) NOT NULL
	,
	[brgyDistrict]
		VARCHAR(MAX) NOT NULL
	,
	[cityMunicipality]
		VARCHAR(MAX) NOT NULL
	,
	[contactNumber]
		VARCHAR(MAX) NOT NULL
	,
	[email]
		VARCHAR(450) NOT NULL
		CONSTRAINT FK_email@JobSeekers FOREIGN KEY
			REFERENCES [UserAccounts] ([email])
	,
	[description]
		VARCHAR(MAX) NOT NULL
	,
	[skills]
		VARCHAR(MAX) NOT NULL
	,
	[experiences]
		VARCHAR(MAX) NOT NULL
	,
	[education]
		VARCHAR(MAX) NOT NULL
)


-- Employers Table
CREATE TABLE [Employers] (
	[employerID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_employerID@Employers PRIMARY KEY
	,
	[companyName]
		VARCHAR(MAX) NOT NULL
	,
	[street]
		VARCHAR(MAX) NOT NULL
	,
	[brgyDistrict]
		VARCHAR(MAX) NOT NULL
	,
	[cityMunicipality]
		VARCHAR(MAX) NOT NULL
	,
	[contactNumber]
		VARCHAR(MAX) NOT NULL
	,
	[email]
		VARCHAR(450) NOT NULL
		CONSTRAINT FK_email@Employers FOREIGN KEY
			REFERENCES [UserAccounts] ([email])
	,
	[website]
		VARCHAR(MAX)
	,
	[description]
		VARCHAR(MAX) NOT NULL
)


-- JobPosts Table
CREATE TABLE [JobPosts] (
	[jobPostID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_jobPostID@JobPosts PRIMARY KEY
	,
	[employerID]
		INT NOT NULL
		CONSTRAINT FK_employerID@JobPosts FOREIGN KEY
			REFERENCES [Employers] ([employerID])
	,
	[jobTitle]
		VARCHAR(MAX) NOT NULL
	,
	[jobType]
		VARCHAR(MAX) NOT NULL
		CONSTRAINT CK_jobType@JobPosts
			CHECK ([jobType] IN (
				'Full Time',
				'Part Time',
				'Internship/OJT',
				'Temporary'
			))
	,
	[industryType]
		VARCHAR(MAX) NOT NULL
	,
	[description]
		VARCHAR(MAX) NOT NULL
	,
	[responsibilities]
		VARCHAR(MAX) NOT NULL
	,
	[skills]
		VARCHAR(MAX) NOT NULL
	,
	[experiences]
		VARCHAR(MAX) NOT NULL
	,
	[education]
		VARCHAR(MAX) NOT NULL
	,
	[minSalary]
		MONEY NOT NULL
		CONSTRAINT CK_minSalary@JobPosts
			CHECK ([minSalary] > 0)
	,
	[maxSalary]
		MONEY NOT NULL
		CONSTRAINT CK_maxSalary@JobPosts
			CHECK ([maxSalary] > 0)
	,
	[dateCreated]
		DATETIME NOT NULL DEFAULT GETDATE()
	,
	[dateModified]
		DATETIME
	,
	[jobPostFlag]
		BINARY NOT NULL
)


-- Applications Table
CREATE TABLE [Applications] (
	[applicationID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_applicationID@Applications PRIMARY KEY
	,
	[jobPostID] 
		INT NOT NULL
		CONSTRAINT FK_jobPostID@Applications FOREIGN KEY
			REFERENCES [JobPosts] ([jobPostID])
	,
	[jobseekerID]
		INT NOT NULL
		CONSTRAINT FK_jobseekerID@Applications FOREIGN KEY
			REFERENCES [JobSeekers] ([jobseekerID])
	,
	[status]
		VARCHAR(MAX) NOT NULL DEFAULT 'Pending'
		CONSTRAINT CK_status@Applications
			CHECK ([status] IN (
				'Pending',
				'Hired',
				'Call Back',
				'Rejected'
			))
	,
)


-- Bookmarks Table
CREATE TABLE [Bookmarks] (
	[bookmarkID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_bookmarkID@Bookmarks PRIMARY KEY
	,
	[jobseekerID]
		INT NOT NULL
		CONSTRAINT FK_jobseekerID@Bookmarks FOREIGN KEY
			REFERENCES [JobSeekers] ([jobseekerID])
	,
	[jobPostID]
		INT NOT NULL
		CONSTRAINT FK_jobPostID@Bookmarks FOREIGN KEY
			REFERENCES [JobPosts] ([jobPostID])
)


-- Notifications Table
CREATE TABLE [Notifications] (
	[notificationID]
		INT NOT NULL IDENTITY(1,1)
		CONSTRAINT PK_notificationID@Notifications PRIMARY KEY
	,
	[title]
		VARCHAR(MAX) NOT NULL
	,
	[message]
		VARCHAR(MAX) NOT NULL
	,
	[senderID]
		INT NOT NULL
		CONSTRAINT FK_senderID@Notifications FOREIGN KEY
			REFERENCES [UserAccounts] ([userID])
	,
	[receiverID]
		INT NOT NULL
		CONSTRAINT FK_receiverID@Notifications FOREIGN KEY
			REFERENCES [UserAccounts] ([userID])
	,
	[readFlag]
		BINARY NOT NULL DEFAULT 0
)

--------------------------------------------------------
